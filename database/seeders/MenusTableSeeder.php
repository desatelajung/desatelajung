<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        Menu::create(['name' => 'Dashboard', 'link' => '/dashboard', 'icon' => 'fas fa-home']);
        Menu::create(['name' => 'Orders', 'link' => '/orders', 'icon' => 'fas fa-file']);
        Menu::create(['name' => 'Products', 'link' => '/products', 'icon' => 'fas fa-shopping-cart']);
        Menu::create(['name' => 'Customers', 'link' => '/customers', 'icon' => 'fas fa-users']);
        Menu::create(['name' => 'Reports', 'link' => '/reports', 'icon' => 'fas fa-chart-line']);
        Menu::create(['name' => 'Integration', 'link' => '/integrations', 'icon' => 'fas fa-puzzle-piece']);
        Menu::create(['name' => 'Current month', 'link' => '/current-months', 'icon' => 'fas fa-file-alt']);
        Menu::create(['name' => 'Last quarter', 'link' => '/last-quarters', 'icon' => 'fas fa-file-alt']);
        Menu::create(['name' => 'Social engagement', 'link' => '/social-engagements', 'icon' => 'fas fa-file-alt']);
        Menu::create(['name' => 'Year-end sale', 'link' => '/year-end-sales', 'icon' => 'fas fa-file-alt']);
        Menu::create(['name' => 'Menu', 'link' => '/menus', 'icon' => 'fas fa-bars']);
        Menu::create(['name' => 'Sub Menu', 'link' => '/submenus', 'icon' => 'fas fa-bars']);
        Menu::create(['name' => 'Role', 'link' => '/roles', 'icon' => 'fas fa-user-tag']);
        Menu::create(['name' => 'Access Menu', 'link' => '/role-menu-accesses', 'icon' => 'fas fa-user-lock']);
        Menu::create(['name' => 'Settings', 'link' => '/settings', 'icon' => 'fas fa-cogs']);
        Menu::create(['name' => 'Sign out', 'link' => '/sign-out', 'icon' => 'fas fa-door-closed']);
        // Add more menus if needed
    }
}
