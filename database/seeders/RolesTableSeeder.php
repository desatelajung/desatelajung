<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Regular User', 'description' => null]);
        Role::create(['name' => 'Operator', 'description' => null]);
        Role::create(['name' => 'Administrator', 'description' => null]);
        Role::create(['name' => 'Sub Leader', 'description' => null]);
        Role::create(['name' => 'Leader', 'description' => null]);
        Role::create(['name' => 'Supervisor', 'description' => null]);
        Role::create(['name' => 'Manajer', 'description' => null]);
        Role::create(['name' => 'CEO', 'description' => null]);
    }
}
