<?php
/**
 * Created by PhpStorm.
 * User: mamad
 * Date: 05/06/2020
 * Time: 05:32 PM
 */

namespace App\Services;

use App\Models\Notif;
use App\Models\NotifType;

class NotificationService
{

    public function notification($user, $status)
    {
        $type = NotifType::where('name', $status)->first();
        if ($type) {
            $this->create($user, $type->id);
        } elseif ($status == 'active') {
            $this->delete($user);
        }
    }

    public function create($user, $type)
    {
        Notif::create([
            'user_id' => $user,
            'notif_types_id' => $type,
        ]);
    }


    public function read($id)
    {
        $notif = Notif::find($id);
        $notif->update(['active' => 0]);
    }

    public function delete($user)
    {
        $notifications = Notif::where('user_id', $user)->get();
        foreach ($notifications as $notification) {
            $notification->delete();
        }
    }
}

