<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    /** @use HasFactory<\Database\Factories\AvatarFactory> */
    use HasFactory;

    protected $hidden = ["created_at", "updated_at"];
}
