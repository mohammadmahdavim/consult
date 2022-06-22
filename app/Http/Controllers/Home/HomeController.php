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
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Input;


class HomeController extends Controller
{
    public function index()
    {
        $sliders = slider::all();
        $services = service::with('images')->where('active',1)->get();
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
            ->where('show',1)
            ->orderBy('sort')
            ->get();

        return view('home.consult', ['consults' => $consults]);
    }

    public function consultSingle($id){
        $consults = consult::with('user')->where('field_school_id',$id)
            ->where('show',1)
            ->orderBy('sort')
            ->get();
        return view('home.consultSingle', ['consults' => $consults]);


    }

    public function service()
    {
        $services = service::with('images')->where('active',1)

            ->get();

        return view('home.service', ['services' => $services]);
    }

    public function blog()
    {
        $blogs = blog::with('images')->paginate(4);
        $tags = tag::all();
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
        return view('home.contact_us', ['fields' => $fields, 'payes' => $payes]);
    }

    public function about_us()
    {
        $about = about::first();

        return view('home.about_us', ['about' => $about]);

    }

    public function contact_store(Request $request)
    {
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
