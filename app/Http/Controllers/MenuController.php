<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Role;
use App\Models\RoleMenuAccess;

class MenuController extends Controller
{
    // Menampilkan daftar menu
    public function index()
    {
        // Periksa apakah ID peran tersedia dalam sesi
        if (!session()->has('role_id')) {
            // Jika tidak tersedia, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $roleId = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $role = Role::findOrFail($roleId);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();

        // Dapatkan semua peran
        $roles = Role::all();

        // Dapatkan semua menu
        $allMenus = Menu::all();

        // Dapatkan semua akses menu berdasarkan peran
        $roleMenuAccesses = RoleMenuAccess::all();

        // Tampilkan view dengan data yang diperlukan
        return view('menus.index', compact('sidebars', 'allMenus', 'roles', 'role', 'roleMenuAccesses'));
    }

    // Menampilkan form untuk membuat menu baru
    public function create()
    {
        // Periksa apakah ID peran tersedia dalam sesi
        if (!session()->has('role_id')) {
            // Jika tidak tersedia, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $roleId = session()->get('role_id');

        // Dapatkan data peran berdasarkan ID
        $menu = Role::findOrFail($roleId);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();

        // Dapatkan semua akses menu berdasarkan peran
        $menuAccesses = RoleMenuAccess::all();

        // Dapatkan semua menu
        $allMenus = Menu::all();
        // Dapatkan semua peran
        $roles = Role::all();

        // Tampilkan view dengan data yang diperlukan
        return view('menus.create', compact('menu', 'sidebars', 'allMenus', 'roles', 'menuAccesses'));
    }

    // Menyimpan menu baru yang dibuat
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required', // Menambahkan aturan validasi untuk kolom 'icon'
            // Tambahkan aturan validasi lainnya jika diperlukan
        ]);

        // Mencoba menyimpan menu baru
        try {
            Menu::create([
                'name' => $request->name,
                'link' => $request->link,
                'icon' => $request->icon, // Menambahkan kolom 'icon'
                // Tambahkan kolom lain jika diperlukan
            ]);

            // Redirect dengan pesan sukses jika berhasil
            return redirect()->route('menus.index')->with('success', 'Menu created successfully.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create menu.']);
        }
    }

    // Menampilkan form untuk mengedit menu
    public function edit(Menu $menu)
    {
        // Periksa apakah ID peran tersedia dalam sesi
        if (!session()->has('role_id')) {
            // Jika tidak tersedia, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $roleId = session()->get('role_id');

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();

        // Dapatkan semua peran

        // Dapatkan semua akses menu berdasarkan peran
        $menuAccesses = RoleMenuAccess::all();

        // Dapatkan data menu yang akan diedit
        $menuToEdit = Menu::findOrFail($menu->id);

        // Dapatkan semua menu
        $allMenus = Menu::all();
        // Dapatkan semua peran
        $roles = Role::all();

        // Tampilkan view dengan data yang diperlukan
        return view('menus.edit', compact('menu', 'sidebars', 'allMenus', 'roles', 'menuAccesses', 'menuToEdit'));
    }

    // Menyimpan perubahan yang diterapkan pada menu yang diedit
    public function update(Request $request, Menu $menu)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ]);

        // Memperbarui menu dengan data baru
        $menu->update([
            'name' => $request->name,
            'link' => $request->link,
            'icon' => $request->icon,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    // Menghapus menu
    public function destroy(Menu $menu)
    {
        // Menghapus menu
        $menu->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }

    // Menampilkan detail menu
    public function show(Menu $menu)
    {
        // Periksa apakah ID peran tersedia dalam sesi
        if (!session()->has('role_id')) {
            // Jika tidak tersedia, redirect ke halaman login
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Ambil ID peran dari sesi
        $roleId = session()->get('role_id');

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();

        // Dapatkan semua peran
        $roles = Role::all();
        // Dapatkan semua peran
        $submenus = SubMenu::all();
        // Dapatkan semua peran
        $allMenus = Menu::all();

        // Dapatkan semua akses menu berdasarkan peran
        $roleMenuAccesses = RoleMenuAccess::all();

        // Dapatkan data menu yang akan ditampilkan
        $menuToShow = Menu::findOrFail($menu->id);

        return view('menus.show', compact('menu', 'sidebars', 'allMenus', 'submenus', 'roles', 'roleMenuAccesses', 'menuToShow'));
    }
}
