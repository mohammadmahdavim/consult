<?php

namespace App\Http\Controllers\Panel\Home;

use App\Http\Controllers\Controller;
use App\Models\slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
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
        $rows = slider::with('images')->get();
        return view('panel.home.slider.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('panel.home.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->except('file');
        $row = slider::create($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {

                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 1200, 600, 'slider_photos');

                $row->images()->create(['file' => $file_name]);
            }
        }

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/slider');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = slider::where('id', $id)
            ->first();


        return view('panel.home.slider.edit', ['row' => $row]);
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
        $row = slider::find($id);
        $inputs = $request->except('file');
        $row->update($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 1200, 600, 'slider_photos');
                $row->images()->create(['file' => $file_name]);
            }
        }

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = slider::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
