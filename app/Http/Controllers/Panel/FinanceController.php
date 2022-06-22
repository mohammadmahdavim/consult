<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use App\Models\Student;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;

class FinanceController extends Controller
{

    public $imageService;


    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Finance::with('authorRow')
            ->with('images')
            ->with('user')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('panel.finance.index', ['rows' => $rows]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = User::where('role', 'student')->select('id', 'name', 'family')->get();

        return view('panel.finance.create', ['students' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $finance = Finance::create([
            'author' => 5,
            'user_id' => $request->user_id,
            'price' => $request->price,
            'description' => $request->description,
            'status' => 1
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $file_name = rand(1, 1000) . time() . '.' . $file->extension();
            $this->imageService->store($file_name, $file, 400, 300, 'finance_photos');
            $finance->images()->create(['file' => $file_name]);
        }
        $student = Student::where('user_id', $request->user_id)->first();

        $student->update(['status' => 'success']);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return redirect('panel/finance');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $row = Finance::find($id);
        $row->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function changeStatus($id, $status)
    {
        $RTamas = Finance::find($id);
        $RTamas->status = $status;
        $RTamas->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
