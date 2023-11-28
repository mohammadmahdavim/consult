<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use App\Models\Student;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use function alert;
use function auth;
use function back;
use function view;

class ReminderController extends Controller
{
    public function index($id)
    {

        $row = Student::where('id', $id)
            ->with('user.reminder')
            ->first();
        return view('panel.student.modal.reminder', ['row' => $row])->render();

    }

    public function store(Request $request)
    {
        Reminder::create([
            'author' => auth()->user()->id,
            'user_id' => $request->user_id,
            'date' => $request->date,
            'comment' => $request->comment,
        ]);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }

    public function destroy($id)
    {
        $row = Reminder::find($id);
        $row->delete();
    }

    public function list()
    {
        $now = Jalalian::now()->format('Y/m/d');
        $rows = Reminder::where('date', $now)->with('user')->get();

        return view('panel.reminder.index', ['rows' => $rows]);
    }
}
