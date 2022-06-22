<?php
/**
 * Created by PhpStorm.
 * User: mamad
 * Date: 05/06/2020
 * Time: 05:32 PM
 */

namespace App\Services;


use App\Models\ServiceStudent;
use App\Models\Student;
use App\Models\transaction;
use App\Models\User;
use Morilog\Jalali\Jalalian;


class StudentService
{

    public $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;

    }

    public function getStudent($request)
    {
        $students = Student::with('user.images')
            ->with('state')
            ->with('serviceActive')
            ->with('city')
            ->with('field')
            ->with('paye')
            ->with('service')
            ->with('serviceActive.consult.user')
            ->with('consult.user')
//            ->whereHas('service', function ($q) use ($request) {
//                if ( Input::get('service')) {
//                    $q->where('service_id', $request->service);
//                }
//            })
            ->whereHas('user', function ($q) use ($request) {
                if ($request->get('name')) {
                    $q->where('name', 'like', '%' . $request->name . '%')
                        ->orwhere('family', 'like', '%' . $request->name . '%');
                }
                if ($request->get('national_code')) {
                    $q->where('national_code', 'like', '%' . $request->national_code . '%');
                }
            })
            ->when($request->get('field'), function ($query) use ($request) {
                $query->whereIn('field_id', $request->field);
            })
            ->when($request->get('paye'), function ($query) use ($request) {
                $query->whereIn('paye_id', $request->paye);
            })
            ->when($request->get('status'), function ($query) use ($request) {
                if ($request->status == 'active') {
                    $query->whereIn('status', [$request->status, 'mid-term','72','24']);
                } else {
                    $query->where('status', [$request->status]);

                }
            })
            ->orderByDesc('created_at');
        return $students;
    }

    public function setStatus($id)
    {

        $student = Student::where('id', $id)->select('id', 'user_id', 'status')->first();
        $nowStatus = $student->status;
        $status = $this->checkFinance($student->user_id);

        if ($status == 'active') {
            $status = $this->checkService($id);
        }

        $student->update(['status' => $status]);
        if ($nowStatus != $status) {
            $this->notificationService->notification($student->user_id, $status);
        }
    }

    public function checkFinance($user)
    {
        $remaining = transaction::where('user_id', $user)->pluck('remaining')->first();
        $user = User::find($user);
        if ($remaining > 0) {
            $user->update(['active' => 0]);
            return 'inactive';
        }
        $user->update(['active' => 1]);

        return 'active';

    }

    public function checkService($id)
    {
        $services = ServiceStudent::where('student_id', $id)->active()->orderBy('end', 'Desc')->pluck('end')->first();
        if (!$services) {
            return 'inactive';
        }
        $services = explode('/', $services);
        $now = Jalalian::now()->getTimestamp();
        $services = (new Jalalian($services[0], $services[1], $services[2]))->getTimestamp();
        $expire = ($services - $now) / 86400;

        if ($expire > 3 and $expire < 15 and ServiceStudent::where('student_id', $id)->count() == 1) {
            $status = 'mid-term';
        } elseif (1 < $expire and $expire < 3) {
            $status = '72';
        } elseif ($expire > 0 and $expire < 1) {
            $status = '24';
        } elseif ($expire > 3) {
            $status = 'active';
        } else {
            $status = 'inactive';
        }
        return $status;
    }

}

