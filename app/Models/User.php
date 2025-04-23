<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        "name",
        "email",
        "password",
        "user_name",
        "first_name",
        "avatar_id",
        "role_id",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        "password",
        "remember_token",
        "created_at",
        "updated_at",
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Avatar::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, "project_users");
    }
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "user_users",
            "admin_user_id",
            "id",
            "id",
            "assignee_user_id"
        );
    }

    public function hasPermission(string $permissionCode): bool
    {
        return $this->role()
            ->whereHas("permissions", function ($query) use ($permissionCode) {
                $query->where("code", $permissionCode);
            })
            ->exists();
    }
}
