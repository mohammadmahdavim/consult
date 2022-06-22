<?php

namespace App\Http\Controllers\Panel\Home;

use App\Http\Controllers\Controller;
use App\Models\about;
use App\Services\ImageService;
use Illuminate\Http\Request;

class AboutController extends Controller
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
        $row = about::all()->first();
        return view('panel.home.about_us.edit', ['row' => $row]);
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
        $row = about::find($id);
        $inputs = $request->except('file', 'tag');
        $row->update($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 50, 50, 'about_us_photos');
                $row->images()->create(['file' => $file_name]);
            }
        }

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/about_us');
    }

}
