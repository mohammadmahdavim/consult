<?php

namespace App\Exports;

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

        return Student::with('user.images')
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
    }

    public function headings(): array
    {
        return [
            'نام',
            'مشاور',
            'کد ملی',
            'شهر',
            'رشته',
            'پایه',
            'تاریخ ثبت نام',
        ];
    }

    public function map($preflight): array
    {

        return [
            $preflight->user->name . ' ' . $preflight->user->family,
            $preflight->serviceActive->consult->user->name . ' ' . $preflight->serviceActive->consult->user->family,
            $preflight->user->national_code,
            $preflight->state->title,
            $preflight->field->title,
            $preflight->paye->title,
            $preflight->serviceLast->start,
        ];

    }


}
