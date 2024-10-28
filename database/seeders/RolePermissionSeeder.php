<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'Pemilik'
        ]);
        $staffRole = Role::create([
            'name' => 'Staff'
        ]);

        $user = User::create([
            'name' => 'Alfin',
            'email' => 'alfin@gmail.com',
            'password' => bcrypt('123123123')
        ]);

        $user->assignRole($ownerRole);
    }
}
