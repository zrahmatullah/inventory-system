<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\ScopeActive;

class Menu extends Model
{
    use ScopeActive;

    protected $table = 'menus';

    protected $fillable = [
        'module_id',
        'name',
        'path',
        'icon',
        'order_no',
        'is_active'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function userMenus()
    {
        return $this->hasMany(UserMenu::class,'menu_id');
    }
}