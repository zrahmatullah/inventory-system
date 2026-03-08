<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{

    protected $table = 'user_login_history_t';

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}