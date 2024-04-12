<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run():void
    {
        Role::create([
            'id' => 1,
            'role' => 'admin'
        ]);

        Role::create([
            'id' => 2,
            'role' => 'client'
        ]);

        User::create([
            'role_id' => 1,
            'username' => 'admin',
            'name' => 'admin',
            'email' => "admin@admin.com",
            'password' => Hash::make('12345678'),
        ]);
    }
}
