<?php

namespace App\Http\Controllers\Panel;

use App\Exports\CallerDebtExport;
use App\Exports\FinanceExport;
use App\Exports\ManagerFinanceExport;
use App\Http\Controllers\Controller;
use App\Imports\UploadUsers;
use App\Imports\UserImport;
use App\Models\consult;
use App\Models\FinanceSection;
use App\Models\Image;
use App\Models\service;
use App\Models\ServiceStudent;
use App\Models\state;
use App\Models\Student;
use App\Models\User;
use App\Services\ServiceService;
use App\Services\StudentService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;


class PanelController extends Controller
{

    public $serviceService;
    public $studentService;
    public $transactionService;

    public function __construct(ServiceService $serviceService, StudentService $studentService, TransactionService $transactionService)
    {
        $this->serviceService = $serviceService;
        $this->studentService = $studentService;
        $this->transactionService = $transactionService;
        $this->middleware('auth');

    }

    public function index()
    {
        if (auth()->user()->role == 'consult') {
            $id = consult::where('user_id', auth()->user()->id)->pluck('id')->first();
            $studentsActiveId = ServiceStudent::where('consult_id', $id)->where('active', 1)->pluck('student_id');
            $studentsActiveId = $studentsActiveId->unique();
            $studentsActive = Student::whereIn('id', $studentsActiveId)->count();
            $studentsDeactive = ServiceStudent::where('consult_id', $id)->whereNOtIN('student_id', $studentsActiveId)->where('active', 0)->pluck('student_id');
            $studentsDeactive = $studentsDeactive->unique();
            $studentsDeactive = Student::whereIn('id', $studentsDeactive)->with('user')->with('field')->count();
            $consult = consult::where('id', $id)->with('service')->first();
            $amount=0;
            foreach ($consult->service as $service) {
                $amount=$amount+$service->financeConsult->amount;
            }
            return view('panel.index', ['studentsDeactive' => $studentsDeactive, 'studentsActive' => $studentsActive,'amount'=>$amount]);

        }

        return view('panel.index');
    }

    public function state_city(Request $request)
    {
        $data['city'] = state::where("parent", $request->state_id)
            ->get(["title", "id"]);
        return response()->json($data);
    }

    public function deleteImage($id)
    {
        $row = Image::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function updateSite()
    {
        $this->serviceService->check();
        $students = Student::all();
        foreach ($students as $student) {
            $this->transactionService->calculation($student->id);
            $this->studentService->setStatus($student->id);
        }
        $this->transactionService->debtConsult();
        return back();
    }

    public function uploadUser(Request $request)
    {
        $this->validate($request, [
            'import_file' => 'required|mimes:xlsx,csv'
        ]);
        $path = $request->file('import_file')->getRealPath();
        Excel::import(new UserImport(), $path);

        return back();
    }

    public function manager_debt()
    {
        $rows = FinanceSection::where('type_id', 4)->where('amount', null)
            ->whereHas('service', function ($q) {
            })
            ->get();

        return view('panel.manager.debt', ['rows' => $rows]);
    }

    public function manager_debt_export(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new ManagerFinanceExport($request), $date . '' . 'خروجی بدهکاری به مدیریت در تاریخ.xlsx');
    }

    public function manager_clear()
    {
        $services = FinanceSection::where('type_id', 2)->whereNotNull('amount')
            ->pluck('service_student_id');
        $rows = FinanceSection::where('type_id', 4)->whereIn('service_student_id', $services)->where('amount', null)
            ->get();
        foreach ($rows as $row) {
            $studentPrice = FinanceSection::where('type_id', 1)->where('service_student_id', $row->service_student_id)->pluck('amount')->first();
            $consultPrice = FinanceSection::where('type_id', 2)->where('service_student_id', $row->service_student_id)->first();
            $callerPrice = FinanceSection::where('type_id', 3)->where('service_student_id', $row->service_student_id)->pluck('amount')->first();
            $amount = $studentPrice - ($consultPrice->amount + $callerPrice);
            $row->update(['amount' => $amount, 'date' => $consultPrice->date]);
        }
    }

    public function finance(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new FinanceExport($request), $date . '' . 'خروجی مالی در تاریخ.xlsx');
    }


}
