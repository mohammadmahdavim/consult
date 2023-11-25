<?php
    /**
     * Created by PhpStorm.
     * User: mamad
     * Date: 05/06/2020
     * Time: 05:32 PM
     */

    namespace App\Services;


    use App\Models\FinanceSection;
    use App\Models\service;
    use App\Models\ServiceStudent;
    use App\Models\Student;
    use App\Models\transaction;
    use App\Models\User;

    class TransactionService
    {
        public function calculation($id)
        {
            $student = Student::where('id', $id)->select('id', 'user_id')->first();

            $total = $this->StudentService($id);
            $paid = $this->StudentPaid($student);
            $remaining = $total - $paid;

            $transaction = transaction::where('user_id', $student->user_id)->first();

            if ($transaction) {
                $this->update($transaction, $total, $paid, $remaining);
            } else {
                $this->create($student->user_id, $total, $paid, $remaining);
            }
        }

        public function StudentService($id)
        {
            $services = ServiceStudent::where('student_id', $id)->select('student_id', 'service_id')
                ->with([
                    'service' => function ($query) {
                        $query->select('id', 'price');
                    },
                ])
                ->get();

            $price = 0;
            foreach ($services as $service) {
                $price = $price + $service->service->price;
            }
            return $price;
        }

        public function StudentPaid($student)
        {

            $paid = User::where('id', $student->user_id)->first()->finance()->sum('amount');
            return $paid;
        }

        public function StudentAnother()
        {

        }

        public function create($user, $total, $paid, $remaining)
        {
            transaction::create([
                'user_id' => $user,
                'total' => $total,
                'paid' => $paid,
                'remaining' => $remaining
            ]);
        }

        public function update($transaction, $total, $paid, $remaining)
        {
            $transaction->update([
                'total' => $total,
                'paid' => $paid,
                'remaining' => $remaining
            ]);
        }

        public function debtConsult()
        {
            
            $service = service::whereNotIn('month', ['1'])->pluck('id');
            $serviceStudents = ServiceStudent::whereIn('service_id', $service)->pluck('id');
            $rows = FinanceSection::where('type_id', 2)->whereIn('service_student_id', $serviceStudents)
            // ->where('id',5323)
                ->with('service.service')
                ->get();
               
            foreach ($rows as $row) {
// dd();
                $servicePrice=$row->service->service->price;
                $servicePricePerMounth=$servicePrice/$row->service->service->month;
                $servicePricePerMounthConsult=$servicePricePerMounth*0.39;
                // dd($servicePrice,$servicePricePerMounth);
                $expire = $row->service->start;
                $date = explode('/', $expire);
                $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
                $gregorian = implode('-', $toGregorian);
                $dateEx = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
                $nowTimestamp = \Morilog\Jalali\Jalalian::forge("now")->getTimestamp();
                $expire = ($nowTimestamp - $dateEx) / 2592000;

                if ($expire < $row->service->service->month + 1) {
                    $expire = floor($expire);
                } else {
                    $end = $row->service->end;
                    $date = explode('/', $end);
                    $toGregorian = \Morilog\Jalali\CalendarUtils::toGregorian($date[0], $date[1], $date[2]);
                    $gregorian = implode('-', $toGregorian);
                    $end = \Morilog\Jalali\Jalalian::forge("$gregorian")->getTimestamp();
                    $expire = ($end - $dateEx) / 2592000;
                    $expire = floor($expire);
                }
                $price = 0;
                if ($expire >= 1) {
                    $price = $servicePricePerMounthConsult;
                }
                if (1 < $expire and $expire <= $row->service->service->month) {

                    $price =$price+ $servicePricePerMounthConsult;
                }
                if (2 < $expire) {
                    
                    $price = $price + ((($expire - 2) *$servicePricePerMounthConsult));
                }
                $pay = $row->amount;
                                // dd($price,$pay,$expire,$servicePricePerMounthConsult);

                if ($pay < $price) {
                    $row->update(['debt' => 1]);
                } else {
                    $row->update(['debt' => 0]);

                    // }
                }
            }
        }
    }

