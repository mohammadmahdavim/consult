<?php

namespace App\Http\Controllers\Panel\Student;


use App\Http\Controllers\Controller;

use App\Models\dars;
use App\Models\Day;
use App\Models\pattern;
use App\Models\patternItem;
use App\Models\patternItemAnswer;
use App\Models\patternStatus;
use App\Models\Student;
use Illuminate\Http\Request;

class PatternController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index()
    {

        $user = auth()->user();
        $consultId = Student::where('user_id', $user->id)->pluck('consult_id')->first();
        $patterns = pattern::where('consult_id', $consultId)->orderBy('created_at', 'desc')->paginate(20);

        return view('panel.student.pattern.index', ['patterns' => $patterns]);
    }


    public function doros($id)
    {
        $pattern = pattern::find($id);
        $classId = $pattern->class_id;
        $doros = dars::all();
        $days = Day::all();
        $statuses = patternStatus::all();
        $patternItems = patternItem::where('pattern_id', $id)->orderBy('day_id', 'desc')->get();
        $patternItems = $patternItems->groupBy('day_id');
        return view('panel.student.pattern.doros', ['patternItems' => $patternItems, 'doros' => $doros, 'pattern' => $pattern, 'days' => $days, 'statuses' => $statuses]);
    }


    public function date($id)
    {
        return view('panel.student.pattern.date', ['pattern' => $id]);
    }

    public function sabt(Request $request)
    {
        $pattern = pattern::where('id', $request->pattern)->first();
        $patternItem = patternItem::where('pattern_id', $request->pattern)->pluck('dars_id');
        $doros = dars::whereIn('id', $patternItem)->get();
        $answers = patternItemAnswer::where('user_id', auth()->user()->id)->where('date', $request->date)->get();
        $statuses = patternStatus::all();
        return view('panel.student.pattern.sabt', ['statuses' => $statuses, 'pattern' => $pattern, 'answers' => $answers, 'doros' => $doros, 'date' => $request->date]);
    }

    public function sabtDars(Request $request)
    {
//        return $request;
        $this->foreachDorosPattern($request->time, 'time', $request->date);
        $this->foreachDorosPattern($request->status, 'status', $request->date);
        $this->foreachDorosPattern($request->description, 'description', $request->date);
        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return redirect('/panel/students/pattern');
    }

    public function foreachDorosPattern($rows, $column, $date)
    {
        foreach ($rows as $dars => $value) {
            $patternItemAnswer = patternItemAnswer::where('date', $date)->where('dars_id', $dars)->where('user_id', auth()->user()->id)->first();
            if ($patternItemAnswer) {
                $this->patternItemAnswerUpdate($patternItemAnswer, $column, $value);
            } else {
                $this->patternItemAnswerStore($column, $value, $dars, $date);
            }
        }
    }

    public function patternItemAnswerUpdate($patternItem, $key, $value)
    {
        $patternItem->update([$key => $value]);
    }

    public function patternItemAnswerStore($column, $value, $darsId, $date)
    {
//        dd($column,$value);
        patternItemAnswer::create(['user_id' => auth()->user()->id, 'dars_id' => $darsId, $column => $value, 'date' => $date]);
    }
}
