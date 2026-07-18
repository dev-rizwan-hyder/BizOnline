<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'image',
        'title',
        'headline',
        'intro',
        'packages',
        'work',
    ];

    protected $casts = [
        'packages' => 'array',
        'work' => 'array',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
