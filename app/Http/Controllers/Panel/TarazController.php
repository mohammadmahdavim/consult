<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\consult;
use App\Models\Notif;
use App\Models\ServiceStudent;
use App\Models\Student;
use App\Models\Taraz;
use App\Models\Test;
use App\Models\User;
use App\Services\FormService;
use Illuminate\Http\Request;

class TarazController extends Controller
{
    public $FormService;

    public function __construct(FormService $formService)
    {
        $this->FormService = $formService;
    }

    public function index($id)
    {
        $rows = Taraz::select('id', 'author')
            ->where('test_id', $id)
            ->with([
                'authortaraz.consult.serviceActive' => function ($consult) {
                    return $consult->select('id', 'consult_id');
                },
            ])
            ->with([
                'authortaraz.consult' => function ($consult) {
                    return $consult->select('id', 'user_id');
                },
            ])
            ->with([
                'authortaraz' => function ($school) {
                    return $school->select('id', 'name', 'family');
                },
            ])
            ->get();
        $notSendConsults = consult::whereNotIn('user_id', $rows->pluck('author'))
            ->with([
                'serviceActive' => function ($consult) {
                    return $consult->select('id', 'consult_id');
                },
            ])
            ->with([
                'user' => function ($school) {
                    return $school->select('id', 'name', 'family');
                },
            ])
            ->select('id', 'user_id')
            ->get();

        $rows = $rows->groupBy('author');

        return view('panel.taraz.index', ['rows' => $rows, 'notSendConsults' => $notSendConsults]);


    }

    public function create()
    {
        $tests = Test::all();
        $user = User::where('id', auth()->user()->id)->first();
        if ($user->role == 'admin') {
            $students = Student::with('user')->get();
        } elseif ($user->role == 'consult') {
            $consult = consult::where('user_id', $user->id)->pluck('id')->first();
            $students = ServiceStudent::where('consult_id', $consult)->pluck('student_id');
            $students = Student::with('user')->whereIn('id', $students)->get();
        }
        return view('panel.taraz.create', ['tests' => $tests, 'students' => $students]);
    }

    public function store(Request $request)
    {
        $rows = $this->FormService->fields($request->fields);

        foreach ($rows as $row) {

            $exite = Taraz::where('student_id', $row['student_id'])->where('test_id', $row['test_id'])->first();
            if ($exite) {
                $exite->update([
                    'all' => $row['all'],
                    'special' => $row['special'],
                    'public' => $row['public'],
                ]);
            } else {
                Taraz::create([
                    'student_id' => $row['student_id'],
                    'test_id' => $row['test_id'],
                    'author' => auth()->user()->id,
                    'all' => $row['all'],
                    'special' => $row['special'],
                    'public' => $row['public'],
                ]);
            }
        }
        alert()->success('تراز ها با موفقیت وارد شدند', 'عملیات موفق');

        return back();
    }

    public function karnameh($id)
    {
        $user = User::find($id);
        $student = Student::where('user_id', $id)->pluck('id')->first();
        $tests = Test::all();
        $karnamehs = Taraz::where('student_id', $student)->orderBy('test_id', 'desc')->get();
        $students = Student::where('user_id', $id)->get();
        return view('panel.taraz.karnameh', ['user' => $user, 'karnamehs' => $karnamehs, 'students' => $students, 'tests' => $tests]);

    }

    public function destroy($id)
    {
        $row = Taraz::find($id);
        $row->delete();
    }
}
