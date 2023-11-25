<?php

namespace App\Http\Controllers\Panel\Home;

use App\Exports\ConsultDebtExport;
use App\Exports\ConsultSxport;
use App\Exports\StudentExport;
use App\Exports\SuperConsultDebtExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultRequest;
use App\Models\consult;
use App\Models\field;
use App\Models\FieldSchool;
use App\Models\FinanceSection;
use App\Models\state;
use App\Models\university;
use App\Models\User;
use App\Models\year;
use App\Services\ImageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class ConsultController extends Controller
{
    public $imageService;
    public $userService;

    public function __construct(ImageService $imageService, UserService $userService)
    {
        $this->imageService = $imageService;
        $this->userService = $userService;
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rows = consult::with('user.images')
            ->with('state')
            ->with('city')
            ->with('field')
            ->with('university')
            ->with('year')
            ->with([
                'serviceActive' => function ($query) {
                    $query->with(['student' => function ($qu) {
                        $qu->with(['user' => function ($q) {
                            $q->addSelect('id', 'family', 'name');
                        }]);
                        $qu->addSelect('id', 'user_id');
                    }]);
                    $query->select(['id', 'consult_id', 'student_id']);
                },
            ])
            ->get();

        return view('panel.home.consult.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = field::all();
        $years = year::all();
        $states = state::where('parent', 0)->get();
        $university = university::all();
        $fieldschools = FieldSchool::all();
        return view('panel.home.consult.create', [
            'fields' => $fields,
            'years' => $years,
            'states' => $states,
            'university' => $university,
            'fieldschools' => $fieldschools,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsultRequest $request)
    {

        $role = $request->role;
        $password = Hash::make($request->national_code);
        $user = $this->userService->userCreate($request, $role, $password);
        $user->syncRoles('consult');

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 1080, 1400, 'user_photos');
                $user->images()->create(['file' => $file_name]);
            }
        }
        consult::create([
            'user_id' => $user->id,
            'year_id' => $request->year_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'field_id' => $request->field_id,
            'field_school_id' => $request->field_school_id,
            'rank' => $request->rank,
            'capacity' => $request->capacity,
            'area' => $request->area,
            'university_id' => $request->university_id,
            'description' => $request->description,
        ]);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/consult');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = consult::where('id', $id)->with('user.images')
            ->with('state')
            ->with('city')
            ->with('field')
            ->with('university')
            ->with('year')
            ->first();
        $fields = field::all();
        $years = year::all();
        $states = state::where('parent', 0)->get();
        $university = university::all();
        $fieldschools = FieldSchool::all();

        return view('panel.home.consult.edit', [
            'row' => $row,
            'fields' => $fields,
            'years' => $years,
            'states' => $states,
            'university' => $university,
            'fieldschools' => $fieldschools,

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
        $row = consult::find($id);
        $user = User::where('id', $row->user_id)->first();
        $password = Hash::make($request->national_code);
        $this->userService->userUpdate($user, $request, $password);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 1080, 1400, 'user_photos');
                $user->images()->create(['file' => $file_name]);
            }
        }

        $row->update([
            'year_id' => $request->year_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'field_id' => $request->field_id,
            'university_id' => $request->university_id,
            'description' => $request->description,
            'area' => $request->area,
            'rank' => $request->rank,
            'capacity' => $request->capacity,
            'field_school_id' => $request->field_school_id,
            'sort' => $request->sort,
        ]);

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/consult');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = consult::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function show()
    {
        return view('panel.home.consult.show');
    }

    public function finance($id)
    {
        $consult = consult::where('id', $id)->with('service')->with('service.student.user')->with('service.financeConsult')->first();

        return view('panel.home.consult.finance', ['consult' => $consult]);

    }

    public function financeauth()
    {
        $id = consult::where('user_id', auth()->user()->id)->pluck('id')->first();
        $consult = consult::where('id', $id)->with('service')->with('service.student.user')->with('service.financeConsult')->first();
        return view('panel.home.consult.finance', ['consult' => $consult]);

    }

    public function export(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new ConsultSxport($request), $date . 'consults.xlsx');

    }

    public function debt()
    {
        $rows = FinanceSection::where('type_id', 2)->where('amount', null)->where('debt', 0)
            ->whereHas('service', function ($q) {
                $q->where('start', '<', Jalalian::now()->subMonths(1)->format('Y/m/d'));
            })
            ->get();
        $rows2 = FinanceSection::where('type_id', 2)->where('debt', 1)->get();
        // return $rows2;
        $rows = array_merge($rows->all(), $rows2->all());
        return view('panel.home.consult.debt', ['rows' => $rows]);

    }

    public function consultDebt(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new ConsultDebtExport($request), $date . '' . 'خروجی بدهکاری به مشاور در تاریخ.xlsx');
    }

    public function superdebt()
    {
//        $rows = FinanceSection::where('type_id', 5)->where('amount', null)->where('debt', 0)
//            ->whereHas('service', function ($q) {
//                $q->where('start', '<', Jalalian::now()->subMonths(1)->format('Y/m/d'));
//            })
//            ->get();
//        $rows2 = FinanceSection::where('type_id', 5)->where('debt', 1)->get();
//        $rows = array_merge($rows->all(), $rows2->all());
        $rows = FinanceSection::where('type_id', 5)->where('amount', null)
            ->whereHas('service', function ($q) {
            })
            ->get();
        return view('panel.home.consult.super_debt', ['rows' => $rows]);

    }

    public function superconsultDebt(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new SuperConsultDebtExport(), $date . '' . 'خروجی بدهکاری به سر مشاور در تاریخ.xlsx');
    }
    
    public function changeStatus(Request $request)
    {
        $karnameh = consult::find($request->id);
        $karnameh->show = $request->show;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }


}
