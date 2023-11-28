<?php

namespace App\Exports;

use App\Models\Contact;
use App\Models\FinanceSection;
use App\Models\ServiceStudent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class Contact2Export implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
      
        $rows = DB::table('contactus2')->orderBy('created_at','desc')->get();
        return $rows;
    }
    public function headings(): array
    {
        return [
            'نام',
            'دوره',
            'نوع ثبت نام',
            'شماره موبایل',
                 '2شماره موبایل',
            'کد ملی',
            'شمارنده',
               'مقطع',
                        'رشته',

            'شهر',
            'درس',
              'تاریخ ثبت'
        ];
    }
    public function map($preflight): array
    {
        return [
            $preflight->name,
            $preflight->cource,
            $preflight->type,
            $preflight->mobile,
              $preflight->mobile2,
            $preflight->national_code,
              $preflight->counter,
                  $preflight->maghta,
               $preflight->field,
                $preflight->city,
               $preflight->dars,
               \Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime( $preflight->created_at)),

        ];
    }
}