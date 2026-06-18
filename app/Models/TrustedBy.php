<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrustedBy extends Model
{
    protected $table = 'trusted_bys';

    protected $fillable = [
        'name',
        'logo',
        'logo_text',
        'logo_style',
        'website_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
