<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Submenu;
use App\Models\Menu;

class SubmenuController extends Controller
{
    public function index()
    {
        // Periksa apakah pengguna masuk
        if (!auth()->check()) {
            // Jika tidak, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $user_session_id = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $role_for_sidebar = Role::findOrFail($user_session_id);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($user_session_id) {
            $query->where('role_id', $user_session_id);
        })->get();

        // Dapatkan semua submenu
        $submenus = Submenu::all();
        // Dapatkan semua menu
        $menus = Menu::all();
        return view('submenus.index', compact('sidebars', 'submenus', 'menus'));
    }

    public function create()
    {
        // Periksa apakah pengguna masuk
        if (!auth()->check()) {
            // Jika tidak, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $user_session_id = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $role_for_sidebar = Role::findOrFail($user_session_id);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($user_session_id) {
            $query->where('role_id', $user_session_id);
        })->get();

        // Dapatkan semua menu
        $menus = Menu::all();
        return view('submenus.create', compact('sidebars', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
            'menu_id' => 'required',
            // Tambahkan aturan validasi lainnya jika diperlukan
        ]);

        Submenu::create([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $request->icon,
            'menu_id' => $request->menu_id,
            // Tambahkan kolom lain jika diperlukan
        ]);

        return redirect()->route('submenus.index')
            ->with('success', 'Submenu created successfully.');
    }

    public function edit(Submenu $submenu)
    {
        // Periksa apakah pengguna masuk
        if (!auth()->check()) {
            // Jika tidak, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $user_session_id = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $role_for_sidebar = Role::findOrFail($user_session_id);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($user_session_id) {
            $query->where('role_id', $user_session_id);
        })->get();

        // Dapatkan semua menu
        $menus = Menu::all();
        return view('submenus.edit', compact('sidebars', 'submenu', 'menus'));
    }

    public function update(Request $request, Submenu $submenu)
    {

        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
            'menu_id' => 'required',
            // Tambahkan aturan validasi lainnya jika diperlukan
        ]);

        Submenu::create([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $request->icon,
            'menu_id' => $request->menu_id,
            // Tambahkan kolom lain jika diperlukan
        ]);

        return redirect()->route('submenus.index')
            ->with('success', 'Submenu updated successfully.');
    }

    public function destroy(Submenu $submenu)
    {
        $submenu->delete();
        return redirect()->route('submenus.index')
            ->with('success', 'Submenu deleted successfully.');
    }

    public function show(Submenu $submenu)
    {
        // Periksa apakah pengguna masuk
        if (!auth()->check()) {
            // Jika tidak, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $user_session_id = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $role_for_sidebar = Role::findOrFail($user_session_id);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($user_session_id) {
            $query->where('role_id', $user_session_id);
        })->get();

        // Dapatkan semua menu
        $menus = Menu::all();
        return view('submenus.show', compact('sidebars', 'submenu', 'menus'));
    }
}
