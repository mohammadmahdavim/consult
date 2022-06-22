<?php

namespace App\View\Components;

use App\Models\FinanceSection;
use Illuminate\View\Component;
use Morilog\Jalali\Jalalian;

class DebtConsult extends Component
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
        $countDebtConsult = FinanceSection::where('type_id', 2)->where('amount', null)->where('debt', 0)
            ->whereHas('service', function ($q) {
                $q->where('start', '<', Jalalian::now()->subMonths(1)->format('Y/m/d'));
            })
            ->count();
        $countDebtConsult =$countDebtConsult+ FinanceSection::where('type_id', 2)->where('debt', 1)->count();
        return view('components.debt-consult',['countDebtConsult'=>$countDebtConsult]);
    }
}
