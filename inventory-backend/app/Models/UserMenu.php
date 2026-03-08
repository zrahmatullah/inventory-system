<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\ScopeActive;
use App\Models\User;

class UserMenu extends Model
{
    use ScopeActive;

    protected $table = 'user_menus';

    protected $fillable = [
        'user_id',
        'menu_id',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }
}