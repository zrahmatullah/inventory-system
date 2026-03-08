<?php

namespace App\Models;

use App\Core\Traits\ScopeActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ScopeActive;

    protected $table = 'users';

    /**
     * Mass assignable
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kelompok_user_id',
        'is_active'
    ];

    /**
     * Hidden fields
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean'
        ];
    }

    /**
     * Relasi ke kelompok user
     */
    public function kelompokUser()
    {
        return $this->belongsTo(KelompokUser::class, 'kelompok_user_id');
    }

    /**
     * Relasi login history
     */
    public function loginHistory()
    {
        return $this->hasMany(UserLoginHistory::class, 'user_id');
    }
}