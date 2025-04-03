<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainItem extends Model
{

    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
}
