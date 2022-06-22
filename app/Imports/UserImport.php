<?php

namespace App\Imports;

use App\Models\consult;
use App\Models\ServiceStudent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $codes = User::pluck('national_code')->toArray();
        foreach ($collection as $row) {
            $user = User::where('national_code', $row['national_code'])->first();
            if (!$user and $row['national_code']) {
                $user = User::create([
                    'name' => $row['name'],
                    'family' => $row['family'],
                    'national_code' => $row['national_code'],
                    'password' => Hash::make($row['national_code']),
                    'active' => 1,
                    'gender' => 1,
                    'role' => 'user'
                ]);
                $user->syncRoles('student');
                $student = Student::create([
                    'user_id' => $user->id,
                    'caller' => User::where('national_code', $row['caller'])->pluck('id')->first(),
                ])->id;
                $start[0] = substr($row['start'], 0, 4);
                $start[1] = substr($row['start'], 4, 2);
                $start[2] = substr($row['start'], 6, 2);
                $startTime = $start[0] . '/' . $start[1] . '/' . $start[2];
                $l = $start[1] + $row['period'];
                if ($l < 10) {
                    $l = '0' . $l;
                }
                $end = $start[0] . '/' . $l . '/' . $start[2];
                $consult = consult::where('user_id', User::where('national_code', $row['consult'])->pluck('id')->first())->pluck('id')->first();
                if ($row['period'] == 1) {
                    $service = 1;
                } elseif ($row['period'] == 2) {
                    $service = 2;

                } elseif ($row['period'] == 3) {
                    $service = 3;

                } elseif ($row['period'] == 6) {
                    $service = 4;

                }

                ServiceStudent::create([
                    'student_id' => $student,
                    'consult_id' => $consult,
                    'service_id' => $service,
                    'start' => $startTime,
                    'end' => $end,
                    'active' => '1'
                ]);
            }
        }
    }
}
