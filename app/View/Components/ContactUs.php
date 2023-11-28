<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Contact;

class ContactUs extends Component
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
                $countContact=Contact::whereNull('last_call_date')->count();

        return view('components.contact-us',['countContact'=>$countContact]);
    }
}
