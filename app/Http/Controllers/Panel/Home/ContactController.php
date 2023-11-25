<?php

namespace App\Http\Controllers\Panel\Home;

use App\Exports\ContactExport;
use App\Exports\Contact2Export;
use App\Exports\ManagerFinanceExport;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Morilog\Jalali\Jalalian;

class ContactController extends Controller
{
    public function export(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new ContactExport($request), $date . '' . 'خروجی تماس با ما به مدیریت در تاریخ.xlsx');
    }

    public function export2(Request $request)
    {
        $date = Jalalian::now()->format('Y-m-d');
        return Excel::download(new Contact2Export($request), $date . '' . 'خروجی تماس با ما به مدیریت در تاریخ.xlsx');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::with('FieldSchool')->with('payeSchool')->orderBy('created_at','desc')->paginate(20);

        return view('panel.home.contact_us.index', ['contacts' => $contacts]);
    }

    public function changeStatus($id, $read)
    {
        $RTamas = Contact::find($id);
        $RTamas->read = $read;
        $RTamas->save();

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function update(Request $request,$id)
    {
        $row=Contact::find($id);
        $row->update([
            'description'=>$request->description,
            'status'=>$request->status,
            'last_call_date'=>$request->input('date-picker-shamsi'),
        ]);
        alert('عملیات موفق', 'عملیات با موفقیت انجام شد');
        return back();
    }

}
