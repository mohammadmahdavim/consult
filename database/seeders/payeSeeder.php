<?php

namespace Database\Seeders;

use App\Models\Paye;
use Illuminate\Database\Seeder;

class payeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paye::create(['title'=>'دوازدهم']);
        Paye::create(['title'=>'یازدهم']);
        Paye::create(['title'=>'دهم']);
        Paye::create(['title'=>'نهم']);
        Paye::create(['title'=>'هشتم']);
        Paye::create(['title'=>'هفتم']);
        Paye::create(['title'=>'ششم']);
        Paye::create(['title'=>'پنجم']);
        Paye::create(['title'=>'چهارم']);

    }
}
