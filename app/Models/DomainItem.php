<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainItem extends Model
{

    protected $hidden = [
        "id",
        'created_at',
        'updated_at'
    ];
    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
}
