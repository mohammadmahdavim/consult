<?php

namespace App\Exports;

use App\Models\FinanceSection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Morilog\Jalali\Jalalian;

class SuperConsultDebtExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return   FinanceSection::where('type_id', 5)->where('amount', null)
            ->whereHas('service', function ($q) {
            })
            ->get();
    }
    public function headings(): array
    {
        return [
            'سرمشاور',
            'مشاور',
            'دانش ‌آموز',
            'دوره',
            'مبلغ',
            'شروع دوره',
        ];
    }
    public function map($preflight): array
    {
        return [
            ($preflight->service->student->super_consult ? $preflight->service->student->super_consult->name . ' ' . $preflight->service->student->super_consult->family : ''),
            ($preflight->service->consult->user ? $preflight->service->consult->user->name . ' ' . $preflight->service->consult->user->family : ''),
            ($preflight->service->student->user ? $preflight->service->student->user->name . ' ' . $preflight->service->student->user->family : ''),
            $preflight->service->service->title,
            $preflight->service->service->price,
            $preflight->service->start,
        ];
    }
}
