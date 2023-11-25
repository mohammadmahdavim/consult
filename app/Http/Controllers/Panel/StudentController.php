<?php

namespace App\Http\Controllers\Panel;

use App\Exports\StudentExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultRequest;
use App\Models\consult;
use App\Models\field;
use App\Models\FieldSchool;
use App\Models\FinanceSection;
use App\Models\Paye;
use App\Models\service;
use App\Models\ServiceStudent;
use App\Models\state;
use App\Models\Student;
use App\Models\TypeDocument;
use App\Models\university;
use App\Models\User;
use App\Models\year;
use App\Services\ImageService;
use App\Services\StudentService;
use App\Services\TransactionService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;


class StudentController extends Controller
{
    public $imageService;
    public $userService;
    public $studentService;
    public $transactionService;

    public function __construct(ImageService $imageService, UserService $userService, StudentService $studentService, TransactionService $transactionService)
    {
        $this->imageService = $imageService;
        $this->userService = $userService;
        $this->studentService = $studentService;
        $this->transactionService = $transactionService;
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user->role == 'consult') {
            $consult = consult::where('user_id', $user->id)->pluck('id')->first();
            $students = ServiceStudent::where('consult_id', $consult)->pluck('student_id');
            $rows = $this->studentService->getStudent($request)
                ->whereIn('id', $students)
                ->paginate(20);
        } elseif ($user->role == 'caller') {
            $rows = $this->studentService->getStudent($request)
                ->where('caller', $user->id)
                ->paginate(20);
        } elseif ($user->role == 'super_consult') {
            $rows = $this->studentService->getStudent($request)
                ->where('super_consult_id', $user->id)
                ->paginate(20);
        } else {
            $rows = $this->studentService->getStudent($request)
                ->paginate(20);
        }
        $fields = FieldSchool::all();
        $payes = Paye::all();
        $services = service::all();
        $types = TypeDocument::all();
        $managers = Student::pluck('manager_id')->unique();
        $managers = User::whereIn('id', $managers)->get();
        $callers = User::whereIn('role', ['admin', 'super_consult'])->get();
        $consults = consult::with('user')->get();

        return view('panel.student.index', ['types' => $types, 'consults' => $consults, 'callers' => $callers, 'rows' => $rows, 'services' => $services, 'fields' => $fields, 'payes' => $payes, 'managers' => $managers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payes = Paye::all();
        $fields = FieldSchool::all();
        $states = state::where('parent', 0)->get();
        $services = service::all();
        $callers = User::whereIn('role', ['consult', 'caller', 'admin', 'super_consult'])->get();
        return view('panel.student.create', [
            'payes' => $payes,
            'fields' => $fields,
            'states' => $states,
            'services' => $services,
            'callers' => $callers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->kanoon) {
            $kanoon = 0;
        } else {
            $kanoon = 1;
        }

        $role = $request->role;
        $password = Hash::make($request->national_code);
        $user = $this->userService->userCreate($request, $role, $password);
        $user->syncRoles('student');
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 400, 300, 'user_photos');
                $user->images()->create(['file' => $file_name]);
            }
        }
        $student = Student::create([
            'user_id' => $user->id,
            'state_id' => $request->state_id,
            'caller' => $request->caller,
            'manager_id' => $request->manager_id,
            'super_consult_id' => $request->super_consult_id,
            'city_id' => $request->city_id,
            'field_id' => $request->field_id,
            'paye_id' => $request->paye_id,
            'mobile' => $request->mobile,
            'mobile2' => $request->mobile2,
            'kanoon' => $kanoon,
            'counter' => $request->counter,
            'description' => $request->description,
        ]);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/student');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Student::where('id', $id)->with('user.images')
            ->with('service')
            ->with('consult')
            ->with('state')
            ->with('city')
            ->with('field')
            ->with('paye')
            ->first();
        $payes = Paye::all();
        $states = state::where('parent', 0)->get();
        $fields = FieldSchool::all();
        $services = service::all();
        $callers = User::whereIn('role', ['consult', 'caller', 'admin', 'super_consult'])->get();
        return view('panel.student.edit', [
            'row' => $row,
            'payes' => $payes,
            'states' => $states,
            'fields' => $fields,
            'services' => $services,
            'callers' => $callers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$request->kanoon) {
            $kanoon = 0;
        } else {
            $kanoon = 1;
        }

        $row = Student::find($id);
        $user = User::where('id', $row->user_id)->first();
        $password = Hash::make($request->national_code);
        $this->userService->userUpdate($user, $request, $password);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 400, 200, 'user_photos');
                $user->images()->create(['file' => $file_name]);
            }
        }

        $row->update([
            'paye_id' => $request->paye_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'field_id' => $request->field_id,
            'caller' => $request->caller,
            'manager_id' => $request->manager_id,
            'super_consult_id' => $request->super_consult_id,
            'description' => $request->description,
            'mobile' => $request->mobile,
            'mobile2' => $request->mobile2,
            'kanoon' => $kanoon,
            'counter' => $request->counter,
        ]);
        $services = ServiceStudent::where('student_id', $row->id)->pluck('id');
        $finances = FinanceSection::whereIn('service_student_id', $services)->where('type_id', 3)->get();
        foreach ($finances as $finance) {
            $finance->update(['user_id' => $request->caller]);
        }
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = consult::fide($id);
        $row->delete();
        return 'success';
    }

    public function service($id)
    {
        $student = Student::where('id', $id)
            ->with('service')
            ->with('service.service')
            ->with('service.consult.user')
            ->first();
        $consults = consult::all();
        $services = service::all();
        return view('panel.student.service', ['student' => $student, 'consults' => $consults, 'services' => $services]);
    }

    public function serviceStore(Request $request)
    {
        $inputs = $request->except('_token');
        ServiceStudent::create($inputs);
        $this->transactionService->calculation($request->student_id);
        $this->studentService->setStatus($request->student_id);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }

    public function serviceUpdate(Request $request, $id)
    {
        $inputs = $request->except('_token');

        $service = ServiceStudent::where('id', $id)->first();
        $service->update($inputs);
        $this->transactionService->calculation($service->student_id);
        $this->studentService->setStatus($service->student_id);

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }

    public function serviceShow(Request $request, $id)
    {
        $service = ServiceStudent::find($id);
        $consults = consult::all();
        $services = service::all();
        return view('panel.student.modal.service', ['row' => $service, 'consults' => $consults, 'services' => $services])->render();
    }

    public function serviceFinance(Request $request, $id)
    {
        $service = ServiceStudent::find($id);
        $date = $service->start;
        $amount = service::where('id', $service->service_id)->pluck('price')->first();
        $financeSection = FinanceSection::where('service_student_id', $id)->get();
        $consults = consult::all();
        $services = service::all();
        return view('panel.student.modal.finance', ['date' => $date, 'amount' => $amount, 'row' => $service, 'consults' => $consults, 'services' => $services, 'financeSection' => $financeSection])->render();
    }

    public function serviceFinanceStore(Request $request, $id)
    {
        $serviceStudent = ServiceStudent::where('id', $id)->with('consult.user')->with('student.user')->with('student.callerStudent')->first();
        //   dd($serviceStudent->student->super_consult_id);

        $this->serviceFinanceStoreRow($serviceStudent->student->user->id, 1, $id, $request->amount1, $request->date1, $request->code1);
        $this->serviceFinanceStoreRow($serviceStudent->consult->user->id, 2, $id, $request->amount2, $request->date2, $request->code2);
        $this->serviceFinanceStoreRow($serviceStudent->student->callerStudent->id, 3, $id, $request->amount3, $request->date3, $request->code3);
        $this->serviceFinanceStoreRow(config('global.manager_id'), 4, $id, $request->amount4, $request->date4, $request->code4);
        $this->serviceFinanceStoreRow($serviceStudent->student->super_consult_id, 5, $id, $request->amount5, $request->date5, $request->code5);
        $this->serviceFinanceStoreRow($serviceStudent->consult->user->id, 6, $id, $request->amount6, $request->date6, $request->code6);
        $this->transactionService->calculation($serviceStudent->student->id);
        $this->studentService->setStatus($serviceStudent->student->id);
        $this->transactionService->debtConsult();
//        $this->transactionService->debtSuperConsult();
        return back();
    }

    public function serviceFinanceStoreRow($user, $type, $service, $amount, $date, $code)
    {
        $financeSection = FinanceSection::where('service_student_id', $service)->where('type_id', $type)->first();

        if (!$financeSection) {
            FinanceSection::create([
                'user_id' => $user,
                'author' => auth()->user()->id,
                'type_id' => $type,
                'service_student_id' => $service,
                'amount' => $amount,
                'date' => $date,
                'code' => $code,
            ]);
        } else {
            $financeSection->update([
                'author' => auth()->user()->id,
                'user_id' => $user,
                'amount' => $amount,
                'date' => $date,
                'code' => $code,
            ]);
        }
    }

    public function servicedestroy($id)
    {
        $row = ServiceStudent::find($id);
        $student = $row->student_id;
        $financeSection = FinanceSection::where('service_student_id', $id)->get();
        foreach ($financeSection as $finance) {
            $finance->delete();
        }
        $row->delete();

        $this->transactionService->calculation($student);
        $this->studentService->setStatus($student);
        $this->transactionService->debtConsult();


    }

    public function studentFinance($id)
    {
        $student = Student::where('id', $id)->with('user.transaction')->first();

        $services = ServiceStudent::where('student_id', $id)->with('service')->with('consult.user')->with('finance')->get();
        return view('panel.student.finance', ['student' => $student, 'services' => $services]);
    }

    public function consult($id)
    {
        $studentsActiveId = ServiceStudent::where('consult_id', $id)->where('active', 1)->pluck('student_id');

        $studentsActiveId = $studentsActiveId->unique();

        $studentsActive = Student::whereIn('id', $studentsActiveId)->with('user')->with('field')->with('state')->with('state')->with('city')->get();

        $studentsDeactive = ServiceStudent::where('consult_id', $id)->whereNOtIN('student_id', $studentsActiveId)->where('active', 0)->pluck('student_id');

        $studentsDeactive = $studentsDeactive->unique();

        $studentsDeactive = Student::whereIn('id', $studentsDeactive)->with('user')->with('field')->with('state')->with('state')->with('city')->get();
        return view('panel.student.modal.consult', ['studentsActive' => $studentsActive, 'studentsDeactive' => $studentsDeactive])->render();

    }

    public function delete($id)
    {
        $row = Student::find($id);
        $service = ServiceStudent::where('student_id', $id)->pluck('id');
        $finances = FinanceSection::whereIn('service_student_id', $service)->get();
        foreach ($finances as $finance) {
            $finance->delete();
        }
        $row->delete();
    }

    public function export(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new StudentExport($request), $date . 'students.xlsx');

    }

    public function cancel($id)
    {
        $student = Student::where('id', $id)->first();
        if ($student->status == 'cancel') {
            $student->update([
                'status' => 'active',
            ]);
        } else {
            $student->update([
                'status' => 'cancel',
            ]);
        }
        $service = ServiceStudent::where('student_id', $id)->pluck('id');
        $finances = FinanceSection::whereIn('service_student_id', $service)->get();
        foreach ($finances as $finance) {
            $finance->delete();
        }
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }

    public function count($count)
    {
        $students = Student::withCount('service')->get();
        $students = $students->where('service_count', $count);
        return view('panel.student.count', ['rows' => $students]);
    }

    public function single(Request $request, $id)
    {


        $rows = $this->studentService->getStudent($request)
            ->where('id', $id)
            ->paginate(20);
        $fields = FieldSchool::all();
        $payes = Paye::all();
        $services = service::all();
        $types = TypeDocument::all();

        return view('panel.student.index', ['types' => $types, 'rows' => $rows, 'services' => $services, 'fields' => $fields, 'payes' => $payes]);
    }

    public function forward(Request $request)
    {
        $row = Student::where('id', $request->student)->with('user')->first();
        DB::disconnect();
        Config::set('database.connections.mysql.database', 'kanoonba_1402');
        DB::reconnect();
        $user = User::create([
            'name' => $row->user->name,
            'section' => $row->user->section,
            'family' => $row->user->family,
            'gender' => $row->user->gender,
            'national_code' => $row->user->national_code,
            'mobile' => $row->user->mobile,
            'role' => 'student',
            'password' => Hash::make($row->user->national_code),
        ]);
        $user->syncRoles('student');
        $student = Student::create([
            'user_id' => $user->id,
            'state_id' => $row->state_id,
            'caller' => $row->caller,
            'manager_id' => $row->manager_id,
            'super_consult_id' => $row->super_consult_id,
            'city_id' => $row->city_id,
            'field_id' => $row->field_id,
            'paye_id' => $request->paye_id,
            'mobile' => $row->mobile,
            'mobile2' => $row->mobile2,
            'kanoon' => $row->kanoon,
            'counter' => $row->counter,
            'description' => $row->description,
        ]);
        DB::disconnect();
        Config::set('database.connections.mysql.database', 'consulting2');
        DB::reconnect();
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }


}
