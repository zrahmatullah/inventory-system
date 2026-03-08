<?php

namespace App\Models;

use App\Core\Traits\ScopeActive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokUser extends Model
{

    use HasFactory, ScopeActive;

    protected $table = 'kelompok_user_m';

    protected $fillable = [
        'nama_kelompok',
        'is_active'
    ];

    /**
     * Relasi ke users
     */
    public function users()
    {
        return $this->hasMany(User::class, 'kelompok_user_id');
    }

}