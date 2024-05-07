<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $menus = Menu::all();
        $submenus = SubMenu::all();
        
        return view('users.index', compact('users', 'menus', 'submenus'));

    }

    public function show(User $user)
    {
        $users = User::all();
        $menus = Menu::all();
        $submenus = SubMenu::all();
        
        return view('users.profile', compact('users', 'menus', 'submenus'));
    }
    // Implement other CRUD methods as needed
}
