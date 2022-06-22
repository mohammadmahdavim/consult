<?php

namespace App\Exports;

use App\Models\consult;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConsultSxport implements FromCollection, WithHeadings, WithMapping
{

    protected
        $request;

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
        return consult::with('user')
            ->with('state')
            ->with('city')
            ->with('field')
            ->with('university')
            ->with('year')
            ->get();
    }

    public function headings(): array
    {
        return [
            'نام',
            'شهر',
            'رشته',
            'دانشگاه',
            'رتبه',
            'ظرفیت',
            'فعال',
            'باقی مانده',
            'تاریخ ثبت نام',
        ];
    }

    public function map($preflight): array
    {

        return [
            $preflight->user->name . ' ' . $preflight->user->family,
            $preflight->city->title,
            $preflight->field->title,
            $preflight->university->title,
            $preflight->rank,
            $preflight->capacity,
            count($preflight->serviceActive),
            $preflight->capacity-count($preflight->serviceActive),
            \Morilog\Jalali\Jalalian::forge($preflight->created_at)->format('%A, %d %B %y'),
        ];

    }

}
