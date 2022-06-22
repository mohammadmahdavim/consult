<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\consult;

use App\Models\Report;
use App\Models\ServiceStudent;
use App\Models\Student;
use App\Models\Taraz;
use App\Models\Task;
use App\Models\TaskType;
use App\Models\Test;
use App\Models\User;
use App\Services\FormService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $FormService;

    public function __construct(FormService $formService)
    {
        $this->FormService = $formService;
    }

    public function create($id)
    {
        $types = TaskType::all();
        $tasks = Task::all();
        $user = User::where('id', auth()->user()->id)->first();
        if ($user->role == 'admin') {
            $students = Student::with('user')->get();
        } elseif ($user->role == 'consult') {
            $consult = consult::where('user_id', $user->id)->pluck('id')->first();
            $students = ServiceStudent::where('consult_id', $consult)->pluck('student_id');
            $students = Student::with('user')->whereIn('id', $students)->get();
        }
        $reports = Report::where('student_id', $id)
            ->with('task')
            ->with('type')
            ->get();
        $user = User::where('id', auth()->user()->id)->first();
        $role = $user->role;
        return view('panel.report.create', ['role' => $role, 'reports' => $reports, 'types' => $types, 'tasks' => $tasks, 'students' => $students, 'id' => $id]);
    }

    public function store(Request $request)
    {


        foreach ($request->task_id as $row) {

            Report::create([
                'student_id' => $request->student_id,
                'task_id' => $row,
                'author' => auth()->user()->id,
                'task_type_id' => $request->type_id,
                'before' => $request->before,
                'after' => $request->after,
                'time' => $request->time,
                'mark' => $request->mark,
            ]);

        }
        alert()->success('اطلاعات ها با موفقیت وارد شدند', 'عملیات موفق');

        return back();
    }


    public function destroy($id)
    {
        $row = Report::find($id);
        $row->delete();
    }

    public function update(Request $request,$id)
    {
        $row=Report::find($id);
        $row->update([
            'task_id' => $request->task_id,
            'task_type_id' => $request->type_id,
            'before' => $request->before,
            'after' => $request->after,
            'time' => $request->time,
            'mark' => $request->mark,
        ]);
        alert()->success('اطلاعات ها با موفقیت ویرایش شدند', 'عملیات موفق');

        return back();
    }
}
