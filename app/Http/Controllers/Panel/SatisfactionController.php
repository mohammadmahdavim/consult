<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Satisfaction;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SatisfactionController extends Controller
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
        $rows = Satisfaction::with('images')->get();

        return view('panel.satisfaction.index', ['rows' => $rows]);
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
        $row = Satisfaction::create($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            ;
            foreach ($image as $index => $file) {

                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 783, 1280, 'service_photos');

                $row->images()->create(['file' => $file_name]);
            }
        }
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/satisfaction');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Satisfaction::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
