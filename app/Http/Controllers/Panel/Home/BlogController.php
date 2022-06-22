<?php

namespace App\Http\Controllers\Panel\Home;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\tag;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public $imageService;


    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = blog::with('images')->with('authorBlog')->with('writerBlog')->paginate(20);;
        return view('panel.home.blog.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereIN('role', ['admin', 'consult'])->get();
        $tags = tag::all();
        return view('panel.home.blog.create', ['users' => $users, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->except('file', 'tag');

        $row = blog::create($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {

                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 300, 300, 'blog_photos');

                $row->images()->create(['file' => $file_name]);
            }
        }
        $row->tag()->sync($request->tag);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/blog');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = blog::where('id', $id)->with([
            'tag' => function ($query) {
                $query->select('id');
            },
        ])
            ->first();
        $users = User::whereIN('role', ['admin', 'consult'])->get();
        $tags = tag::all();

        return view('panel.home.blog.edit', ['row' => $row, 'users' => $users, 'tags' => $tags]);
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
        $row = blog::find($id);
        $inputs = $request->except('file', 'tag');
        $row->update($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 300, 300, 'blog_photos');
                $row->images()->create(['file' => $file_name]);
            }
        }
        $row->tag()->sync($request->tag);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/blog');
    }


    public function delete($id)
    {
        $row = blog::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
