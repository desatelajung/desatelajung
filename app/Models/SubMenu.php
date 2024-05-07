<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table = 'sub_menus';
    protected $fillable = ['menu_id', 'name', 'link', 'icon'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}