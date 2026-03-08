<?php

namespace App\Core\Traits;

trait ScopeActive
{

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}