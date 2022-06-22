<?php
/**
 * Created by PhpStorm.
 * User: mamad
 * Date: 05/06/2020
 * Time: 05:32 PM
 */

namespace App\Services;


use App\Models\User;
use Intervention\Image\Facades\Image;

class UserService
{

    public function userCreate($request, $role, $password)
    {

        $user = User::create([
            'name' => $request->name,
            'section' => $request->section,
            'family' => $request->family,
            'gender' => $request->gender,
            'national_code' => $request->national_code,
            'mobile' => $request->mobile,
            'role' => $role,
            'password' => $password,
        ]);
        return $user;
    }

    public function userUpdate($user, $request, $password)
    {
        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'gender' => $request->gender,
            'section' => $request->section,

            'mobile' => $request->mobile,
            'national_code' => $request->national_code,
            'password' => $password,
        ]);

    }

    public function setStatus()
    {

    }

}

