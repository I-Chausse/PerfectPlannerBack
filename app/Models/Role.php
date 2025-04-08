<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Role extends Model
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }
}
