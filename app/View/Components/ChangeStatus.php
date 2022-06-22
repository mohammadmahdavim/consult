<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ChangeStatus extends Component
{

    public $row;
    public $url;
    public function __construct($row,$url)
    {
        $this->row = $row;
        $this->url = $url;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.change-status');
    }
}
