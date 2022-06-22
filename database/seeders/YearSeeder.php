<?php

namespace Database\Seeders;

use App\Models\year;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        year::create(['title'=>'90']);
        year::create(['title'=>'91']);
        year::create(['title'=>'92']);
        year::create(['title'=>'93']);
        year::create(['title'=>'94']);
        year::create(['title'=>'95']);
        year::create(['title'=>'96']);
        year::create(['title'=>'97']);
        year::create(['title'=>'98']);
        year::create(['title'=>'99']);
        year::create(['title'=>'1400']);

    }
}
