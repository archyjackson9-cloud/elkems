<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'description',
        'mission_statement',
    ];

    /**
     * Retrieve the single about section record, or a new empty instance.
     */
    public static function singleton(): static
    {
        return static::query()->firstOrNew(['id' => 1]);
    }
}
