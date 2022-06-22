<?php

namespace App\View\Components;

use App\Models\FinanceSection;
use App\Models\ServiceStudent;
use Illuminate\View\Component;

class DebtCaller extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $sections = FinanceSection::where('type_id', 3)
            ->whereNotNull('amount')
            ->pluck('service_student_id');
        $studentsId = ServiceStudent::whereIN('id', $sections)->pluck('student_id');
        $countDebtCaller = FinanceSection::where('type_id', 3)->where('amount', null)
            ->whereHas('service', function ($q) use ($studentsId) {
                $q->whereNotIN('student_id', $studentsId);
            })
            ->count();
        return view('components.debt-caller',['countDebtCaller'=>$countDebtCaller]);
    }
}
