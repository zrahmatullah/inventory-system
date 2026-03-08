<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\Traits\ScopeActive;

class Module extends Model
{
    use ScopeActive;

    protected $table = 'modules';

    protected $fillable = [
        'name',
        'icon',
        'order_no',
        'is_active'
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'module_id');
    }
}