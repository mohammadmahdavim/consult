<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\consult;
use App\Models\Notif;
use App\Models\NotifType;
use App\Models\ServiceStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->role == 'admin') {
            $rows = Notif::orderBy('active', 'desc')
                ->orderBy('created_at', 'desc')
                ->with('type')
                ->with('user')
                ->with('user.student')
                ->with('user.student.manager')
                ->whereHas('user', function ($q) use ($request) {
                    if ($request->get('name')) {
                        $q->where('name', 'like', '%' . $request->name . '%')
                            ->orwhere('family', 'like', '%' . $request->name . '%');
                    }
                    if ($request->get('national_code')) {
                        $q->where('national_code', 'like', '%' . $request->national_code . '%');
                    }
                })
                ->when($request->get('type_id'), function ($query) use ($request) {
                    $query->where('notif_types_id', $request->type_id);
                })
                ->when($request->get('manager'),
                function ($query) use ($request) {
                     $query->whereHas('user', function ($q) use ($request) {
                   $q->whereHas('student', function ($q) use ($request) {
                    $q->whereHas('manager', function ($q) use ($request) {
                    $q->where('id',$request->manager);
                });
                });
                });
                })
                ->paginate(20);
                // return $rows[0];
        } elseif ($user->role == 'consult') {
            $consult = consult::where('user_id', $user->id)->pluck('id')->first();
            $students = ServiceStudent::where('consult_id', $consult)->pluck('student_id');
            $students = Student::whereIN('id', $students)->pluck('user_id');
            $rows = Notif::whereIn('user_id', $students)->orderBy('active', 'desc')->orderBy('created_at', 'desc')->with('type')->with('user')->paginate(20);
        } elseif ($user->role == 'student') {
            $rows = Notif::where('user_id', $user->id)->orderBy('active', 'desc')->orderBy('created_at', 'desc')->with('type')->with('user')->paginate(20);
        }
        $types = NotifType::all();
        $managers=User::whereIn('id',['689','39'])->get();
        return view('panel.notification.index', ['rows' => $rows,'managers' => $managers, 'types' => $types]);
    }

    public function changeStatus($id, $status)
    {
        $pattern = Notif::find($id);
        $pattern->active = $status;
        $pattern->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
