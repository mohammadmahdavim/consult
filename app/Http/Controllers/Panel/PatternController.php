<?php

namespace App\Http\Controllers\Panel;

use App\Models\consult;
use App\Models\dars;
use App\Models\Day;
use App\Models\pattern;
use App\Models\patternItem;
use App\Models\patternItemAnswer;
use App\Models\patternStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Jalalian;

class PatternController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = auth()->user();

        if ($user->role == 'consult') {
            $patterns = pattern::where('author', $user->id)->paginate(20);
        } else {
            $patterns = pattern::paginate(20);
        }


        return view('panel.pattern.index', ['patterns' => $patterns]);
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role == 'consult') {
            $allclas = consult::where('user_id', $user->id)->get();
        } else {
            $allclas = consult::all();
        }


        return view('panel.pattern.create', ['allclas' => $allclas]);
    }

    public function store(Request $request)
    {
        $this->validate(request(),
            [
                'name' => 'required',
                'date_from' => 'required',
                'class_id' => 'required',
            ]
        );
        $pattern = pattern::create([
            'author' => auth()->user()->id,
            'name' => $request->name,
            'date_from' => $request->date_from,
            'date_to' => $request->input('date-picker-shamsi-list'),
            'consult_id' => $request->class_id,
            'status' => 1,
        ]);

        $classId = $pattern->class_id;
        $doros = dars::all();

        $this->storeDorosItem($doros, $pattern->id);

        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return redirect('/panel/pattern/doros/' . $pattern->id);
    }

    public function edit($id)
    {
        $row = pattern::find($id);
        $user = auth()->user();

        if ($user->role == 'consult') {
            $allclas = consult::where('user_id', $user->id)->get();
        } else {
            $allclas = consult::all();
        }

        return view('panel.pattern.edit', ['row' => $row, 'allclas' => $allclas]);

    }

    public function update(Request $request, $id)
    {
        $this->validate(request(),
            [
                'name' => 'required',
                'date_from' => 'required',
                'class_id' => 'required',
            ]
        );
        $pattern = pattern::find($id);

        $pattern->update([
            'name' => $request->name,
            'date_from' => $request->date_from,
            'date_to' => $request->input('date-picker-shamsi-list'),
            'consult_id' => $request->class_id,
            'status' => 1,
        ]);

        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return back();
    }

    public function changeStatus($id, $status)
    {
        $pattern = pattern::find($id);
        $pattern->status = $status;
        $pattern->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function doros($id)
    {
        $pattern = pattern::find($id);

        $doros = dars::all();
        $days = Day::all();
        $statuses = patternStatus::all();
        $patternItems = patternItem::where('pattern_id', $id)->orderBy('day_id', 'desc')->get();
        $patternItems = $patternItems->groupBy('day_id');
        return view('panel.pattern.doros', ['patternItems' => $patternItems, 'doros' => $doros, 'pattern' => $pattern, 'days' => $days, 'statuses' => $statuses]);
    }

    public function dorosStore(Request $request)
    {
        $pattern = $request->pattern;
        $this->foreachDorosPattern($request->time, 'time', $pattern);
        $this->foreachDorosPattern($request->status, 'status', $pattern);
        $this->foreachDorosPattern($request->description, 'description', $pattern);
        alert()->success('عملیات با موفقیت انجام شد.', 'عملیات موفق');
        return back();
    }


    public
    function destroy($id)
    {
        $pattern = pattern::find($id);
        $pattern->delete();
    }

    public function storeDorosItem($doros, $pattern)
    {
        $days = Day::all();

        foreach ($doros as $dars) {
            foreach ($days as $day) {
                patternItem::create(['pattern_id' => $pattern, 'day_id' => $day->id, 'dars_id' => $dars->id]);

            }
        }
    }

    public function foreachDorosPattern($rows, $column, $pattern)
    {
        foreach ($rows as $day => $days) {
            foreach ($days as $darsId => $row) {
                $patternItem = patternItem::where('pattern_id', $pattern)->where('dars_id', $darsId)->where('day_id', $day)->first();
                if ($patternItem) {
                    $this->patternItemUpdate($patternItem, $column, $row);
                } else {
                    $this->patternItemStore($pattern, $column, $row, $day, $darsId);
                }
            }
        }
    }

    public function patternItemUpdate($patternItem, $key, $value)
    {
        $patternItem->update([$key => $value]);

    }

    public function patternItemStore($paaternId, $key, $value, $day, $darsId)
    {
        patternItem::create(['pattern_id' => $paaternId, 'day_id' => $day, 'dars_id' => $darsId, $key => $value]);

    }

    public function dailyReport()
    {
        return view('panel.pattern.report.date');

    }

    public function daily(Request $request)
    {
        $answers = patternItemAnswer::where('date', '>=', $request->date_from)->where('date', '<=', $request->date_to)->with('dars')->with('statuss')->whereNotNull('time')->get();
        $answers = $answers->groupBy('user_id');
        return view('panel.pattern.report.daily', ['answers' => $answers, 'date_from' => $request->date_from, 'date_to' => $request->date_to]);
    }

    public function monthReport()
    {
        return view('panel.pattern.report.monthReport');
    }

    public function month(Request $request)
    {
        $dateFrom = '1400/' . $request->month . '/00';
        $dateTo = '1400/' . $request->month . '/31';
        $answers = patternItemAnswer::where('date', '>=', $dateFrom)->where('date', '<=', $dateTo)->whereNotNull('time')->get();
        $answers = $answers->groupBy('user_id');
        $dates = [];
        for ($i = 1; $i <= 31; $i++) {
            if ($i < 10) {
                $dates[] = '1400/' . $request->month . '/0' . $i;
            } else {
                $dates[] = '1400/' . $request->month . '/' . $i;
            }
        }

        return view('panel.pattern.report.month', ['answers' => $answers, 'month' => $request->month, 'dates' => $dates]);
    }
}


