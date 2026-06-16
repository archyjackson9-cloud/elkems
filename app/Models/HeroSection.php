<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'heading',
        'subheading',
        'button_primary_text',
        'button_primary_url',
        'button_secondary_text',
        'button_secondary_url',
        'background_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function active(): ?self
    {
        return static::where('is_active', true)->first();
    }
}
