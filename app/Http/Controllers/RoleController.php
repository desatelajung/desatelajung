<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RoleMenuAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
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

        // Dapatkan semua akses menu berdasarkan peran
        $roleMenuAccesses = RoleMenuAccess::all();

        return view('roles.index', compact('role', 'roles', 'sidebars', 'roleMenuAccesses'));
    }

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
        $role = Role::findOrFail($roleId);

        // Dapatkan menu yang tersedia untuk peran tersebut
        $sidebars = Menu::whereHas('roleMenuAccesses', function ($query) use ($roleId) {
            $query->where('role_id', $roleId);
        })->get();

        // Dapatkan semua peran
        $roles = Role::all();

        // Dapatkan semua akses menu berdasarkan peran
        $roleMenuAccesses = RoleMenuAccess::all();

        return view('roles.create', compact('role', 'roles', 'sidebars', 'roleMenuAccesses'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Membuat instance Role baru
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;

        // Menyimpan role ke dalam database
        $role->save();

        // Redirect ke halaman indeks role dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Peran baru telah berhasil ditambahkan.');
    }
    public function show(Role $role)
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

        // Dapatkan semua peran
        $roles = Role::all();
        // Dapatkan semua peran
        $menus = Menu::all();
        $roleMenuAccesses = Menu::all();

        // Kembalikan view dengan data yang dibutuhkan
        return view('roles.show', compact('menus', 'role', 'roles', 'sidebars', 'roleMenuAccesses'));
    }


    public function edit(Role $role)
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

        // Dapatkan semua akses menu berdasarkan peran
        $roleMenuAccesses = RoleMenuAccess::all();

        // Dapatkan data peran yang akan diedit
        $roleToEdit = Role::findOrFail($role->id);

        return view('roles.edit', compact('role', 'roles', 'sidebars', 'roleMenuAccesses', 'roleToEdit'));
    }

    public function update(Request $request, Role $role)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Update nama dan deskripsi role
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect ke halaman indeks role dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Peran telah berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        // Periksa apakah ada relasi terkait sebelum menghapus role
        if ($role->users()->exists()) {
            return redirect()->route('roles.index')->with('error', 'Gagal menghapus peran. Masih ada pengguna terkait dengan role ini.');
        }

        // Hapus role dari database
        $role->delete();

        // Redirect ke halaman indeks role dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Peran telah berhasil dihapus.');
    }

    public function updateMenuAccess(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'menu_id' => 'required|exists:menus,id',
            'is_checked' => 'required|boolean',
        ]);

        try {
            $roleId = $validatedData['role_id'];
            $menuId = $validatedData['menu_id'];
            $isChecked = $validatedData['is_checked'];

            // Find the roleMenuAccess record
            $roleMenuAccess = RoleMenuAccess::where('role_id', $roleId)->where('menu_id', $menuId)->first();

            if ($isChecked) {
                // If RoleMenuAccess record does not exist, create it
                if (!$roleMenuAccess) {
                    RoleMenuAccess::create([
                        'role_id' => $roleId,
                        'menu_id' => $menuId,
                    ]);
                }
            } else {
                // If RoleMenuAccess record exists, delete it
                if ($roleMenuAccess) {
                    $roleMenuAccess->delete();
                }
            }

            // Return a success response
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
