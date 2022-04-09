<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movie extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title', "year", "length", "poster", "country_id", "director_id"
    ];


    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function director(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class)->withPivot("role");
    }

    public function attach(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
