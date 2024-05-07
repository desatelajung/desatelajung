<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['name', 'link', 'icon'];

    public function subMenus()
    {
        return $this->hasMany(SubMenu::class);
    }

    public function roleMenuAccesses()
    {
        return $this->hasMany(RoleMenuAccess::class);
    }
}