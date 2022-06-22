<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Requests\SuggestRequest;
use App\Models\Student;
use App\Models\Suggest;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SuggestController extends Controller
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
        $user = auth()->user();

        if ($user->role == 'consult') {
            $rows = Suggest::where('author', $user->id)->with('images')->get();

        } elseif ($user->role == 'student') {
            $consultId = Student::where('user_id', $user->id)->pluck('consult_id')->first();
            $rows = Suggest::where('author', $consultId)->with('images')->get();

        } else {
            $rows = Suggest::with('images')->get();
        }

        return view('panel.suggest.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.suggest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuggestRequest $request)
    {
        $inputs = $request->except('file');
        $row = Suggest::create($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('/Suggest_photos');
                $file->move($path, $file_name);

                $row->images()->create(['file' => $file_name]);
            }
        }
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/suggest');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Suggest::find($id);
        return view('panel.suggest.edit', ['row' => $row]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SuggestRequest $request, $id)
    {
        $row = Suggest::find($id);
        $inputs = $request->except('file');
        $row->update($inputs);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            foreach ($image as $index => $file) {
                $file_name = $index . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('/Suggest_photos');
                $file->move($path, $file_name);
                $row->images()->create(['file' => $file_name]);
            }
        }

        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/suggest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Suggest::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
