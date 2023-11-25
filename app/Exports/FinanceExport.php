<?php

namespace App\Exports;

use App\Models\FinanceSection;
use App\Models\ServiceStudent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class FinanceExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ServiceStudent::
        with([
            'financeConsult' => function ($query) {
                $query->select('id', 'user_id', 'amount', 'date', 'service_student_id');
            },
            'financePenalty' => function ($query) {
                $query->select('id', 'user_id', 'amount', 'date', 'service_student_id');
            },
            'financeConsult.user' => function ($query) {
                $query->select('id', 'name', 'family');
            },
            'financeSuperConsult' => function ($query) {
                $query->select('id', 'user_id', 'amount', 'date', 'service_student_id');
            },
            'financeSuperConsult.user' => function ($query) {
                $query->select('id', 'name', 'family');
            },
            'financeStudent' => function ($query) {
                $query->select('id', 'user_id', 'amount', 'date', 'service_student_id');
            },
            'financeStudent.user' => function ($query) {
                $query->select('id', 'name', 'family');
            },
            'financeCaller' => function ($query) {
                $query->select('id', 'user_id', 'amount', 'date', 'service_student_id');
            },
            'financeCaller.user' => function ($query) {
                $query->select('id', 'name', 'family');
            },
            'financeManager' => function ($query) {
                $query->select('id', 'user_id', 'amount', 'date', 'service_student_id');
            },
            'financeManager.user' => function ($query) {
                $query->select('id', 'name', 'family');
            },
            'service' => function ($query) {
                $query->select('id', 'title');
            },
        ])
            ->get();
    }

    public function headings(): array
    {
        return [
            'دوره',
            'مدیر',
            'دانش آموز',
            'مبلغ دانش آموز',
            'تاریخ واریز دانش آموز',
            'مشاور',
            'مبلغ مشاور',
            'تاریخ واریز مشاور',
            'جذب',
            'مبلغ جذب',
            'تاریخ واریز جذب',
            'مدیریت',
            'مبلغ مدیریت',
            'تاریخ واریز مدیریت',
            'سر مشاور',
            'مبلغ سر مشاور',
            'تاریخ واریز سر مشاور',
            'مبلغ جریمه',
            'تاریخ ثبت جریمه',
            'مانده',
        ];
    }

    public function map($preflight): array
    {
        return [
            $preflight->service->title,
            ($preflight->student->manager ? $preflight->student->manager->name . ' ' . $preflight->student->manager->family : ''),

            ($preflight->financeStudent->user ? $preflight->financeStudent->user->name . ' ' . $preflight->financeStudent->user->family : ''),

            $preflight->financeStudent->amount,
            $preflight->financeStudent->date,
            ($preflight->financeConsult->user ? $preflight->financeConsult->user->name . ' ' . $preflight->financeConsult->user->family : ''),
            $preflight->financeConsult->amount,
            $preflight->financeConsult->date,
            ($preflight->financeCaller->user ? $preflight->financeCaller->user->name . ' ' . $preflight->financeCaller->user->family : ''),
            $preflight->financeCaller->amount,
            $preflight->financeCaller->date,
            ($preflight->financeManager->user ? $preflight->financeManager->user->name . ' ' . $preflight->financeManager->user->family : ''),
            $preflight->financeManager->amount,
            $preflight->financeManager->date,
            ($preflight->financeSuperConsult->user ? $preflight->financeSuperConsult->user->name . ' ' . $preflight->financeSuperConsult->user->family : ''),
            $preflight->financeSuperConsult->amount,
            $preflight->financeSuperConsult->date,
            $preflight->financePenalty->amount,
            $preflight->financePenalty->date,
            $preflight->financeStudent->amount - ($preflight->financeConsult->amount + $preflight->financeCaller->amount + $preflight->financeManager->amount + $preflight->financeSuperConsult->amount + $preflight->financePenalty->amount)
        ];
    }
}
