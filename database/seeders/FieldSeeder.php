<?php

namespace Database\Seeders;


use App\Models\field;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        field::create(['title' => 'پزشکی']);
        field::create(['title' => 'دندانپزشکی']);
        field::create(['title' => 'مهندسی برق']);
        field::create(['title' => 'مهندسی مکانیک']);
        field::create(['title' => 'مهندسی شیمی']);
        field::create(['title' => 'مهندسی پزشکی']);
        field::create(['title' => 'مهندسی پلیمر']);
        field::create(['title' => 'مهندسی عمران']);
        field::create(['title' => 'حقوق']);
        field::create(['title' => 'وکالت']);
        field::create(['title' => 'داروسازی']);

    }
}
