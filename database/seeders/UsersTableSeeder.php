<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // Assume role_id 1 is for regular user
            'status' => 1 // Assume status 1 is for active
        ]);
        User::create([
            'name' => 'Reza',
            'email' => 'reza@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // Assume role_id 1 is for regular user
            'status' => 1 // Assume status 1 is for active
        ]);

        // Add more users if needed
    }
}
