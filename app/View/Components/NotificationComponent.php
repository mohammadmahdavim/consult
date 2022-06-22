<?php

namespace App\View\Components;

use App\Models\consult;
use App\Models\Notif;
use App\Models\ServiceStudent;
use App\Models\Student;
use Illuminate\View\Component;

class NotificationComponent extends Component
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
        $count=0;
        $user = auth()->user();
        if ($user->role == 'admin') {
            $count = Notif::active()->count();
        } elseif ($user->role == 'consult') {
            $consult = consult::where('user_id', $user->id)->pluck('id')->first();
            $students = ServiceStudent::where('consult_id', $consult)->pluck('student_id');
            $students = Student::whereIN('id', $students)->pluck('user_id');
            $count = Notif::whereIn('user_id', $students)->active()->count();
        } elseif ($user->role == 'student') {
            $count = Notif::where('user_id', $user->id)->active()->count();
        }
        return view('components.notification-component', ['count' => $count]);
    }
}
