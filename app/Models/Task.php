<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "project_id",
        "domain_item_status_id",
        "domain_item_flag_id",
        "user_id",
        "description",
        "remaining_time",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function status(): HasOne
    {
        return $this->hasOne(DomainItem::class, "id", "domain_item_status_id");
    }

    public function flag(): HasOne
    {
        return $this->hasOne(DomainItem::class, "id", "domain_item_flag_id");
    }

    public function assignableUsers(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Project::class);
    }
}
