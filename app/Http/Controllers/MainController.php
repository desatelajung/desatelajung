<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Role;

class MainController extends Controller
{
    public function index()
    {
        // Ambil ID peran dari sesi
        $roleId = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $role = Role::findOrFail($roleId);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();

        return view('index', compact('sidebars'));
    }
}
