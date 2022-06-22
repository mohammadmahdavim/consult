<?php

namespace App\View\Components;

use App\Models\FinanceSection;
use Illuminate\View\Component;
use Morilog\Jalali\Jalalian;

class DebtorManager extends Component
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
        $countDebtManager = FinanceSection::where('type_id', 4)->where('amount', null)
            ->whereHas('service', function ($q) {
            })
            ->count();
        return view('components.debtor-manager', ['countDebtManager' => $countDebtManager]);
    }
}
