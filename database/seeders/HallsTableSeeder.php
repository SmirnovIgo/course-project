<?php

namespace Database\Seeders;

//php artisan db:seed --class=HallsTableSeeder - не добавилась в таблицу

use Illuminate\Database\Seeder;
use App\Models\Hall;

class HallsTableSeeder extends Seeder
{
    public function run()
    {
        Hall::create([
            'name' => 'Зал 1',
            'location' => 'Кременчуг',
        ]);

        Hall::create([
            'name' => 'Зал 2',
            'location' => 'Полтава',
        ]);

    }
}

