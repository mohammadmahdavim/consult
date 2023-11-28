<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Morilog\Jalali\Jalalian;

class Reminder extends Component
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
        $now = Jalalian::now()->format('Y/m/d');
        $count = \App\Models\Reminder::where('date', $now)->count();
        return view('components.reminder', ['count' => $count]);
    }
}
