<?php

namespace App\Exports;

use App\Models\consult;
use App\Models\ServiceStudent;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class StudentExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = $this->request;

        $studentsList= Student::with('user.images')
            ->with('state')
            ->with('city')
            ->with('field')
            ->with('paye')
            ->with('service')
            ->with('serviceActive.consult.user')
            ->with('consult.user')
            ->whereHas('service', function ($q) use ($request) {
                if ($request->get('service')) {
                    $q->where('service_id', $request->service);
                }
            })

            ->whereHas('user', function ($q) use ($request) {
                if ($request->get('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%')
                        ->orwhere('family', 'like', '%' . $request->name . '%');
                }
                if ($request->get('national_code')) {
                    $q->where('national_code', 'like', '%' . $request->national_code . '%');
                }
            })
            ->when($request->get('field'), function ($query) use ($request) {
                $query->whereIn('field_id', $request->field);
            })
            ->when($request->get('paye'), function ($query) use ($request) {
                $query->whereIn('paye_id', $request->paye);
            })
            ->when($request->get('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        $user = auth()->user();
        if ($user->role == 'consult') {
            $consult = consult::where('user_id', $user->id)->pluck('id')->first();
            $students = ServiceStudent::where('consult_id', $consult)->pluck('student_id');
            $rows = $studentsList->whereIn('id', $students);
        }  elseif ($user->role == 'super_consult') {
            $rows = $studentsList->where('super_consult_id', $user->id);
        } else {
            $rows = $studentsList;
        }
        return $rows;
    }

    public function headings(): array
    {
        return [
            'نام',
            'مدیر',
            ' سر مشاور',
            'مشاور',
            'دوره',
            'کد ملی',
            'شهر',
            'رشته',
            'پایه',
            'تاریخ ثبت نام',
            'تاریخ پایان دوره',
        ];
    }

    public function map($preflight): array
    {

        return [
            $preflight->user->name . ' ' . $preflight->user->family,
            $preflight->manager->name . ' ' . $preflight->manager->family,
            $preflight->super_consult->name . ' ' . $preflight->super_consult->family,
            $preflight->serviceActive->consult->user->name . ' ' . $preflight->serviceActive->consult->user->family,
            $preflight->serviceActive->service->title,
            $preflight->user->national_code,
            $preflight->state->title,
            $preflight->field->title,
            $preflight->paye->title,
            $preflight->serviceLast->start,
            $preflight->serviceActive->end,

        ];

    }


}
