<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Manager;

class ManagersTableSeeder extends Seeder
{
    public function run()
    {
        Manager::create([
            'name' => 'Manager 1',
            'email' => 'manager1@example.com',
            'password' => bcrypt('password'), 
        ]);

        Manager::create([
            'name' => 'Manager 2',
            'email' => 'manager2@example.com',
            'password' => bcrypt('password'),
        ]);

       
    }
}

