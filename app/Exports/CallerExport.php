<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CallerExport implements FromCollection, WithHeadings, WithMapping
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
        return User::where('role','caller')->get();
    }

    public function headings(): array
    {
        return [
            'نام',
            'موبایل',
            'کدملی',
            'جنسیت',
            'تاریخ ثبت نام',
        ];
    }

    public function map($preflight): array
    {

        return [
            $preflight->name . ' ' . $preflight->family,
            $preflight->mobile,
            $preflight->national_code,
            $preflight->gender,
            \Morilog\Jalali\Jalalian::forge($preflight->created_at)->format('%A, %d %B %y'),
        ];

    }

}
