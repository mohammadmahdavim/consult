<?php

namespace App\Exports;

use App\Models\FinanceSection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class ManagerFinanceExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return   FinanceSection::where('type_id', 4)->where('amount', null)
            ->whereHas('service', function ($q) {
            })
            ->get();
    }
    public function headings(): array
    {
        return [
            'دانش ‌آموز',
                   'مدیر',
            'دوره',
            'مبلغ',
            'شروع دوره',
        ];
    }
    public function map($preflight): array
    {
        return [
            ($preflight->service->student->user ? $preflight->service->student->user->name . ' ' . $preflight->service->student->user->family : ''),
            $preflight->service->student->manager->name. ' '. $preflight->service->student->manager->family,
            $preflight->service->service->title,
                $preflight->service->service->price,
            $preflight->service->start,
        ];
    }
}
