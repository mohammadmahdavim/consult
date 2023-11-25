<?php

namespace App\Http\Controllers\Panel;

use App\Exports\CommentExport;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Student;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class CommentController extends Controller
{
    public function index($id)
    {
        $row = Student::where('id', $id)
            ->with('user.document')
            ->first();
        $types = TypeDocument::all();
        return view('panel.student.modal.comment', ['row' => $row, 'types' => $types])->render();

    }

    public function store(Request $request)
    {
        if (!$request->show) {
            $show = 0;
        } else {
            $show = 1;
        }
        Document::create([
            'author' => auth()->user()->id,
            'user_id' => $request->user_id,
            'type_id' => $request->type_id,
            'title' => $request->title,
            'body' => $request->body,
            'show' => $show,
        ]);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }

    public function destroy($id)
    {
        $row = Document::find($id);
        $row->delete();
    }

    public function export()
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new CommentExport(), $date . '' . 'خروجی کامنت ها در تاریخ.xlsx');
    }
}
