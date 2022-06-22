<?php

namespace Database\Seeders;

use App\Models\university;
use Illuminate\Database\Seeder;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        university::create(['title'=>'شریف']);
        university::create(['title'=>'تهران']);
        university::create(['title'=>'پلی تکنیک']);
        university::create(['title'=>'علم وصنعت']);
        university::create(['title'=>'خواجه نصیر']);
        university::create(['title'=>'شهید بهشتی']);
        university::create(['title'=>'ایران']);
    }
}
