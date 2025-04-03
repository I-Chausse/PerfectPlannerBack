<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainItem extends Model
{
    /** @use HasFactory<\Database\Factories\DomainItemFactory> */
    use HasFactory;

    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
}
