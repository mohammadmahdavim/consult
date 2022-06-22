<?php

namespace App\Exports;

use App\Models\FinanceSection;
use App\Models\ServiceStudent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CallerDebtExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sections = FinanceSection::where('type_id', 3)
            ->whereNotNull('amount')
            ->pluck('service_student_id');
        $studentsId = ServiceStudent::whereIN('id', $sections)->pluck('student_id');
        $rows = FinanceSection::where('type_id', 3)->where('amount', null)
            ->whereHas('service', function ($q) use ($studentsId) {
                $q->whereNotIN('student_id', $studentsId);
            })
            ->get();
        return $rows;
    }
    public function headings(): array
    {
        return [
            'جذب کننده',
            'دانش ‌آموز',
            'دوره',
            'شروع دوره',
        ];
    }
    public function map($preflight): array
    {
        return [
            ($preflight->service->student->callerStudent ? $preflight->service->student->callerStudent->name . ' ' . $preflight->service->student->callerStudent->family : ''),
            ($preflight->service->student->user ? $preflight->service->student->user->name . ' ' . $preflight->service->student->user->family : ''),
            ($preflight->service->service ? $preflight->service->service->title . ' ' . $preflight->service->service->price : ''),
            $preflight->service->start,

        ];
    }

}
