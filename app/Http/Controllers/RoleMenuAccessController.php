<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;
use App\Models\RoleMenuAccess;

class RoleMenuAccessController extends Controller
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

        $roleMenuAccesses = RoleMenuAccess::all();
        $roles = Role::all();
        $menus = Menu::all();

        return view('role_menu_accesses.index', compact('sidebars', 'roleMenuAccesses', 'roles', 'menus'));
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
        $roles = Role::all();
        $menus = Menu::all();

        return view('role_menu_accesses.create', compact('sidebars', 'roleMenuAccesses', 'roles', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_id' => 'required|exists:menus,id',
            // tambahkan validasi lain jika diperlukan
        ]);

        RoleMenuAccess::create($request->all());

        return redirect()->route('role_menu_accesses.index')->with('success', 'Role Menu Access berhasil dibuat.');
    }

    public function edit($id)
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

        $roleMenuAccess = RoleMenuAccess::findOrFail($id);
        $roles = Role::all();
        $menus = Menu::all();

        return view('role_menu_accesses.edit', compact('sidebars', 'roleMenuAccesses', 'roles', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_id' => 'required|exists:menus,id',
            // tambahkan validasi lain jika diperlukan
        ]);

        $roleMenuAccess = RoleMenuAccess::findOrFail($id);
        $roleMenuAccess->update($request->all());

        return redirect()->route('role_menu_accesses.index')->with('success', 'Role Menu Access berhasil diperbarui.');
    }

    public function show($id)
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

        $roleMenuAccess = RoleMenuAccess::findOrFail($id);

        return view('role_menu_accesses.show', compact('sidebars', 'roleMenuAccesses', 'roles', 'menus'));
    }

    public function destroy($id)
    {
        $roleMenuAccess = RoleMenuAccess::findOrFail($id);
        $roleMenuAccess->delete();

        return redirect()->route('role_menu_accesses.index')->with('success', 'Role Menu Access berhasil dihapus.');
    }
}
