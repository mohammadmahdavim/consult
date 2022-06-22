<?php

namespace App\Http\Controllers\Panel;

use App\Exports\CallerDebtExport;
use App\Exports\CallerExport;
use App\Exports\ConsultSxport;
use App\Http\Controllers\Controller;
use App\Models\FinanceSection;
use App\Models\ServiceStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class CallerController extends Controller
{
    public function finance($id)
    {
        $user = User::find($id);
        $rows = FinanceSection::where('user_id', $user->id)->with('service.student.user')->orderBy('amount', 'desc')->get();

        return view('panel.caller.finance', ['rows' => $rows, 'user' => $user]);
    }

    public function export(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new CallerExport($request), $date . 'callers.xlsx');

    }

    public function debt()
    {
        $sections = FinanceSection::where('type_id', 3)
            ->whereNotNull('amount')
            ->pluck('service_student_id');
        $studentsId = ServiceStudent::whereIN('id', $sections)->pluck('student_id');
        $rows = FinanceSection::where('type_id', 3)->where('amount', null)
            ->whereHas('service', function ($q) use ($studentsId) {
                $q->whereNotIN('student_id', $studentsId);
            })
            ->get();
        return view('panel.caller.debt', ['rows' => $rows]);

    }

    public function callerDebt(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new CallerDebtExport($request), $date . '' . 'خروجی بدهکاری به جذب کننده در تاریخ.xlsx');
    }
}
