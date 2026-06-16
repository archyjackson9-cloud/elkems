<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'icon',
        'badge_labels',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Return badge labels as an array.
     */
    public function getBadgesAttribute(): array
    {
        if (!$this->badge_labels) return [];
        return array_filter(array_map('trim', explode(',', $this->badge_labels)));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
