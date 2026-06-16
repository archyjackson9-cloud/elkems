<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'linkedin_url',
        'twitter_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get initials from full name (up to 2 chars).
     */
    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', trim($this->name));
        $initials = '';
        foreach ($parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
            if (strlen($initials) >= 2) break;
        }
        return $initials;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
