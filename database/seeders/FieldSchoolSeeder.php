<?php

namespace Database\Seeders;

use App\Models\FieldSchool;
use Illuminate\Database\Seeder;

class FieldSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FieldSchool::create(['title'=>'تجربی']);
        FieldSchool::create(['title'=>'ریاضی و فیزیک']);
        FieldSchool::create(['title'=>'انسانی']);
        FieldSchool::create(['title'=>'هنرستان']);
        FieldSchool::create(['title'=>'دیگر']);
    }
}
