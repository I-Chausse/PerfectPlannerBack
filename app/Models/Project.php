<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    public function users(): BelongsToMany {
    return $this->belongsToMany(User::class, 'project_users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where('roles.code', 'user');
    }


    public function admins(): BelongsToMany {
        return $this->belongsToMany(User::class, 'project_users')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->where(function($query) {
            $query->where('roles.code', 'project_admin')
                  ->orWhere('roles.code', 'admin');
                }
            );
    }

    public function assignables(): BelongsToMany {
        return $this->belongsToMany(User::class, 'project_users');
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class);
    }
}
