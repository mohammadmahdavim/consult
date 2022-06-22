<?php

namespace App\Http\Controllers\Panel\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\service;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public $imageService;


    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->middleware('auth');
        $this->middleware('auth');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = service::with('images')->get();

        return view('panel.home.service.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.home.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $inputs = $request->except('file');
        $row = service::create($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {

                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 200, 200, 'service_photos');

                $row->images()->create(['file' => $file_name]);
            }
        }
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/service');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = service::find($id);
        return view('panel.home.service.edit', ['row' => $row]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $row = service::find($id);
        $inputs = $request->except('file');
        $row->update($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->extension();
                $this->imageService->store($file_name, $file, 200, 200, 'service_photos');
                $row->images()->create(['file' => $file_name]);
            }
        }

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/home/service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = service::find($id);

        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function changeStatus(Request $request)
    {
        $karnameh = service::find($request->id);
        $karnameh->active = $request->active;
        $karnameh->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
