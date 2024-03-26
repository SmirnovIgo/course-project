<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Client;


class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        Client::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);
    }
}