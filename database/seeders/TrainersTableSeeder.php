<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trainer;

use Illuminate\Support\Facades\Hash;
class TrainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        public function run()
        {
            Trainer::create([
                'name' => 'Trainer 1',
                'email' => 'trainer1@example.com',
                'password' => Hash::make('password'),
            ]);
            
            Trainer::create([
                'name' => 'Trainer 2',
                'email' => 'trainer2@example.com',
                'password' => Hash::make('password'),
            ]);

            
            

            // Здесь вы можете добавить других тренеров
    
            // Добавьте здесь других тренеров, если необходимо
        }
    }
}