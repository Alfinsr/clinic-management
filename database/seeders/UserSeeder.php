<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan User dengan Role 'Owner'
        User::create([
            'name' => 'Owner Name',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
            'role' => 'Owner',
        ]);
    }
}
