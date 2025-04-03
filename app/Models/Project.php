<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    public function users(): HasManyThrough {
        return $this->hasManyThrough(User::class, ProjectUser::class)
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('users.role_code', 'user');
    }

    public function admins(): HasManyThrough {
        return $this->hasManyThrough(User::class, ProjectUser::class)
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where(function($query) {
            $query->where('roles.code', 'project_admin')
                  ->orWhere('roles.code', 'admin');
                }
            );
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class);
    }
}
