<?php

namespace Database\Migrations;

use Illuminate\Database\Seeder;
use App\Models\Time;

class TimesTableSeeder extends Seeder
{
    public function run()
    {
        Time::create([
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
        ]);

        Time::create([
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
        ]);

        // Добавьте здесь другие временные интервалы, если необходимо
    }
}
