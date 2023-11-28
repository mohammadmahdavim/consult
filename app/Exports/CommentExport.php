<?php

namespace App\Exports;

use App\Models\Document;
use App\Models\FinanceSection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Morilog\Jalali\Jalalian;

class CommentExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Document::with('type')
            ->with('AuthorComment')
            ->with('user')
            ->with('user.student')
            ->with('user.student')
            ->with('user.student.consult')
            ->with('user.student.serviceActive.consult.user')
            ->with('user.student.serviceLast.consult.user')
            ->with('user.student.super_consult')->get();
    }

    public function headings(): array
    {
        return [
            'کامنت گذار',
            'دانش ‌آموز',
            'مشاور',
            'سرمشاور',
            'دسته بندی',
            'عنوان',
            'کامنت',
            'تاریخ کامنت',
        ];
    }

    public function map($preflight): array
    {
//        dd($preflight->user->student->super_consult);
        return [
            ($preflight->AuthorComment ? $preflight->AuthorComment->name . ' ' . $preflight->AuthorComment->family : ''),
            ($preflight->user ? $preflight->user->name . ' ' . $preflight->user->family : ''),
            ($preflight->user->student->serviceActive ? $preflight->user->student->serviceActive->consult->user->name . ' ' . $preflight->user->student->serviceActive->consult->user->family : $preflight->serviceLast->consult->user->name.' '.$preflight->serviceLast->consult->user->name),
            ($preflight->user ? $preflight->user->student->super_consult->name . ' ' . $preflight->user->student->super_consult->family : ''),
            $preflight->type->title,
            $preflight->title,
            $preflight->body,
            Jalalian::forge($preflight->created_at)->format('Y-m-d'),
        ];
    }
}
