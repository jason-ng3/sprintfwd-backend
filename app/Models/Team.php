<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'name',
    ];

    // Fetch members for a team
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
