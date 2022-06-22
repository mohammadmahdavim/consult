<?php

namespace App\Exports;

use App\Models\FinanceSection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Morilog\Jalali\Jalalian;

class ConsultDebtExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $row = FinanceSection::where('type_id', 2)->where('amount', null)->where('debt', 0)
            ->whereHas('service', function ($q) {
                $q->where('start', '<', Jalalian::now()->subMonths(1)->format('Y/m/d'));
            })
            ->pluck('id');
        $row2 = FinanceSection::where('type_id', 2)->where('debt', 1)->pluck('id');

        $rows= array_merge($row->all(), $row2->all());
        return FinanceSection::whereIN('id',$rows)->get();
    }

    public function headings(): array
    {
        return [
            'مشاور',
            'دانش ‌آموز',
            'دوره',
            'پایان دوره',
        ];
    }

    public function map($preflight): array
    {

        return [
            ($preflight->service->consult->user ? $preflight->service->consult->user->name . ' ' . $preflight->service->consult->user->family : ''),
            ($preflight->service->student->user ? $preflight->service->student->user->name . ' ' . $preflight->service->student->user->family : ''),
            ($preflight->service->service ? $preflight->service->service->title . ' (' . $preflight->service->service->price . ')' : ''),
            $preflight->service->end,
        ];
    }
}
