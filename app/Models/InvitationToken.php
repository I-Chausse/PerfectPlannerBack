<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class InvitationToken extends Model
{
    protected $fillable = ["role_id", "user_id"];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($invitationToken) {
            $ok = false;
            while (!$ok) {
                $invitationToken->token = random_int(1000, 9999);
                if (!self::where("token", $invitationToken->token)->exists()) {
                    $ok = true;
                }
            }
            $invitationToken->expires_at = now()->addDays(7);
            $invitationToken->creator_user_id = Auth::user()->id;
        });
    }
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, "creator_user_id");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid(): bool
    {
        return !$this->user_id && $this->expires_at > now();
    }
}
