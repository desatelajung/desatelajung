<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubMenu;

class SubMenusTableSeeder extends Seeder
{
    public function run()
    {
        SubMenu::create(['menu_id' => 1, 'name' => 'Overview', 'link' => '/overview']);
        SubMenu::create(['menu_id' => 1, 'name' => 'Analytics', 'link' => '/analytics']);
        // Add more sub-menus if needed
    }
}
