<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domain extends Model
{
    protected $hidden = ["id", "created_at", "updated_at"];
    public function domainItems(): HasMany
    {
        return $this->hasMany(DomainItem::class);
    }
}
