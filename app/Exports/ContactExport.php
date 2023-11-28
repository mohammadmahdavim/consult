<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\FinanceSection;
use App\Models\ServiceStudent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $rows = Contact::with('FieldSchool')
            ->with('payeSchool')
            ->get();
        return $rows;
    }
    public function headings(): array
    {
        return [
            'نام',
            'شماره موبایل',
            'کد ملی',
            'رشته',
            'پایه',
                  'تاریخ ثبت',
            'تاریخ آخرین تماس',
            'وضعیت',
            'توضیحات',
        ];
    }
    public function map($preflight): array
    {
        return [
            $preflight->name,
            $preflight->mobile,
            $preflight->national_code,
            ($preflight->FieldSchool ? $preflight->FieldSchool->title :  ''),
            ($preflight->payeSchool ? $preflight->payeSchool->title :  ''),
           \Morilog\Jalali\Jalalian::forge($preflight->created_at),
            $preflight->last_call_date,
            $preflight->status,
            $preflight->description,

        ];
    }
}
