<?php

namespace App\Http\Controllers\Home;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\about;
use App\Models\blog;
use App\Models\consult;
use App\Models\Contact;
use App\Models\FieldSchool;
use App\Models\Paye;
use App\Models\service;
use App\Models\slider;
use App\Models\tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceStudent;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = slider::all();
        $services = service::with('images')->where('active', 1)->get();
        $consults = consult::take(6)->get();
        $blogs = blog::take(6)->get();
        $fields = FieldSchool::all();
        $payes = Paye::all();
        //        return $services[0]->images[0];
        return view('home.index', [
            'sliders' => $sliders,
            'services' => $services,
            'consults' => $consults,
            'blogs' => $blogs,
            'fields' => $fields,
            'payes' => $payes,
        ]);
    }

    public function consult()
    {
        $consults = consult::with('user')
            ->where('show', 1)
            ->orderBy('sort')
            ->get();

        return view('home.consult', ['consults' => $consults]);
    }

    public function consultSingle($id)
    {
        $consults = consult::with('user')->where('field_school_id', $id)
            ->where('show', 1)
            ->orderBy('sort')
            ->get();
        return view('home.consultSingle', ['consults' => $consults]);


    }

    public function service()
    {
        $services = service::with('images')->where('active', 1)
            ->get();

        return view('home.service', ['services' => $services]);
    }

    public function blog()
    {
        $blogs = blog::with('images')->paginate(4);
        $tags = tag::all();

        $z = DB::table('finance_sections')
            ->join('service_student', 'service_student.id', '=', 'finance_sections.service_student_id')
            ->join('students', 'students.id', '=', 'service_student.student_id')
            ->whereNOtNULL('finance_sections.deleted_at')
            ->whereNull('service_student.deleted_at')
            ->whereNull('students.deleted_at')
            ->distinct('finance_sections.service_student_id')
            ->pluck('finance_sections.service_student_id');

        $x = ServiceStudent::whereIn('id', $z)->has('finance')->pluck('id');
        dd(array_diff($z->toArray(), $x->toArray()));
        return view('home.blog', ['blogs' => $blogs, 'tags' => $tags]);
    }

    public function blog_single($id)
    {
        $blog = blog::where('id', $id)->with('images')->first();
        $tags = tag::all();
        return view('home.blog_single', ['blog' => $blog, 'tags' => $tags]);
    }

    public function contact_us()
    {
        $fields = FieldSchool::all();
        $payes = Paye::all();
        return view('home.contact_us', ['fields' => $fields, 'payes' => $payes, 'id' => '']);
    }

    public function contact_us_with_id($id)
    {
        $fields = FieldSchool::all();
        $payes = Paye::all();
        return view('home.contact_us', ['fields' => $fields, 'payes' => $payes, 'id' => $id]);
    }

    public function about_us()
    {
        $about = about::first();

        return view('home.about_us', ['about' => $about]);

    }

    public function contact_us_2()
    {

        $fields = FieldSchool::all();
        $payes = Paye::all();
        return view('home.contact_us_2', ['fields' => $fields, 'payes' => $payes, 'id' => '']);
    }

    public function contact_us_3()
    {

        $fields = FieldSchool::all();
        $payes = Paye::all();
        return view('home.contact_us_3', ['fields' => $fields, 'payes' => $payes, 'id' => '']);
    }

    public function contact_us_store_2(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'mobile' => 'required|digits:11',
            'mobile2' => 'required|digits:11',
            'counter' => 'nullable|digits:9',
            'national_code' => 'digits:10',
            'cource' => 'required'
        ]);

// foreach($request->dars as $r){
//     $resep[] = $r;
// }
// return json_encode($resep);

        DB::table('contactus2')->insert(
            array(

                'name' => $request->name,
                'cource' => $request->cource,
                'type' => $request->type,
                'national_code' => $request->national_code,
                'mobile' => $request->mobile,
                'mobile2' => $request->mobile2,
                'class' => $request->class,
                'city' => $request->city,
                'counter' => $request->counter,
                'field' => $request->field,
                'maghta' => $request->maghta,
                //   'dars'=>$request->dars,
                'created_at' => now()
            )
        );


        Alert::success('عملیات موفق', 'منتظر تماس ما باشید');

        return back();
    }

    public function contact_store(Request $request)
    {
        $check = Contact::where('mobile', $request->mobile)
            ->where('created_at', '>', Carbon::now()->subHour(1))
            ->first();
        if ($check) {
            Alert::error('عملیات ناموفق', 'تکراری');

            return back();
        }
        Contact::create($request->all());
        Alert::success('عملیات موفق', 'منتظر تماس ما باشید');

        return back();

    }

    public function tagSearch($id)
    {
        $blogs = tag::find($id)->blog()->paginate(8);

        $tags = tag::all();
        return view('home.blog', ['blogs' => $blogs, 'tags' => $tags]);
    }

    public function search(Request $request)
    {
        $blogs = blog::where('title', 'like', '%' . $request->search . '%')
            ->orwhere('little_body', 'like', '%' . $request->search . '%')
            ->orwhere('body', 'like', '%' . $request->search . '%')->paginate(8);
        $tags = tag::all();
        return view('home.blog', ['blogs' => $blogs, 'tags' => $tags]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
