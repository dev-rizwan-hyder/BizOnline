<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'slug',
        'category',
        'image',
        'custom_image',
        'default_image',
        'title',
        'headline',
        'intro',
        'packages',
        'work',
        'features',
        'meta',
    ];

    protected $casts = [
        'packages' => 'array',
        'work' => 'array',
        'features' => 'array',
        'meta' => 'array',
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

    /**
     * Convert features_text (line-separated) to features array for storage
     */
    public static function formatFeatures($featuresText)
    {
        if (is_array($featuresText)) {
            return $featuresText;
        }

        return array_filter(
            array_map('trim', explode("\n", $featuresText)),
            fn($item) => !empty($item)
        );
    }
}
