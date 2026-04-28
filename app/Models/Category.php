<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'icon',
        'projects_count', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** Kategori ini dimiliki banyak project (N:M) */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(
            Project::class,
            'project_categories'
        )->withTimestamps()
         ->where('status', 'published');  // hanya published
    }

    // ══════════════════════════════════════════════════
    // SCOPES
    // ══════════════════════════════════════════════════

    /** Hanya kategori aktif */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /** Urutkan dari yang paling banyak project */
    public function scopePopular($query)
    {
        return $query->orderByDesc('projects_count');
    }
}