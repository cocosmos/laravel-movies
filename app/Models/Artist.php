<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'firstname', 'birthdate', 'country_id', 'image', "user_id"
    ];


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function hasDirected(): HasMany
    {
        return $this->hasMany(Movie::class, "director_id");
    }

    public function hasPlayed(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class)->withPivot("role");
    }
}
