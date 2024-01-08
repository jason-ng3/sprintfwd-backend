<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Projects::class);
    }

    protected $fillable = [
        'first_name', 'last_name', 'city', 'state', 'country', 'team_id'
    ];

    protected $attributes = [
        'city' => NULL,
        'state' => NULL,
        'country' => NULL,
    ];
}
