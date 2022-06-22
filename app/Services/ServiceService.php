<?php
/**
 * Created by PhpStorm.
 * User: mamad
 * Date: 05/06/2020
 * Time: 05:32 PM
 */

namespace App\Services;


use App\Models\ServiceStudent;
use Morilog\Jalali\Jalalian;

class ServiceService
{
    public function check()
    {
        $services = ServiceStudent::all();
        foreach ($services as $service) {
            $end = explode('/', $service->end);
            $end = (new Jalalian($end[0], $end[1], $end[2]))->getTimestamp();
            $now = Jalalian::now()->getTimestamp();
            $expire = $end - $now;
            if ($expire < 0) {
                $service->update(['active' => 0]);
            }

        }
    }

}

