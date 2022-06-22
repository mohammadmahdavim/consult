<?php

namespace App\Http\Controllers;

use App\Models\consult;
use App\Models\field;
use App\Models\FieldSchool;
use App\Models\state;
use App\Models\university;
use App\Models\User;
use App\Models\year;
use App\Services\ImageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public $imageService;
    public $userService;

    public function __construct(ImageService $imageService, UserService $userService)
    {
        $this->imageService = $imageService;
        $this->userService = $userService;
        $this->middleware('auth');

    }
    public function index()
    {
// d
        $userId = auth()->user()->id;
        $user = consult::where('user_id', $userId)->with('user')->first();
        $fields = field::all();
        $years = year::all();
        $states = state::where('parent', 0)->get();
        $university = university::all();
        $fieldschools = FieldSchool::all();
        return view('profile', ['row' => $user,     'fields' => $fields,
            'years' => $years,
            'states' => $states,
            'university' => $university,
            'fieldschools' => $fieldschools,]);
    }

    public function update(Request $request,$id)
    {
        $row = consult::find($id);
        $user = User::where('id', $row->user_id)->first();
        $password = Hash::make($request->national_code);
        $this->userService->userUpdate($user, $request, $password);

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
        return back();
    }

    public function updatepassword(Request $request, $id)
    {

        $this->validate(request(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required',
            ]
        );

        $user = User::find($id);

        if ($request->old_password || $request->new_password || $request->confirm_password) {
            if (!Hash::check($request['old_password'], $user->password)) {
                alert()->error('پسورد وارد شده قبلی شما نادرست است', 'خطا')->autoClose(5000);
                return back();
            } else {
                if ($request->new_password == $request->confirm_password) {
                    $password = Hash::make($request->new_password);
                    $user->update([
                        'password' => $password,
                    ]);
                    alert()->success('ویرایش شما با موفقیت ثبت گردید!', 'موفق');
                    return back();
                } else {
                    alert()->error('رمز عبور با تکرار آن مطابقت ندارد', 'خطا')->autoClose(5000);
                    return back();
                }
            }

        }
    }
}
