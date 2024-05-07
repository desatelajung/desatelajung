<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roleMenuAccesses()
    {
        return $this->hasMany(RoleMenuAccess::class);
    }

    public function roleMenuAccessChecked($role_id, $menu_id)
    {
        // Cek apakah terdapat entri dalam tabel role_menu_access yang sesuai dengan role_id dan menu_id yang diberikan
        $access = RoleMenuAccess::where('role_id', $role_id)
            ->where('menu_id', $menu_id)
            ->exists();

        // Mengembalikan hasil dari pemeriksaan
        return $access ? 'checked' : null;
    }
}
