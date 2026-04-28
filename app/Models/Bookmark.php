<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id', 'project_id', 'collection_name', 'notes',
    ];

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** Bookmark ini milik satu user */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Bookmark ini menunjuk ke satu project */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // ══════════════════════════════════════════════════
    // SCOPES
    // ══════════════════════════════════════════════════

    /** Filter berdasarkan nama koleksi */
    public function scopeInCollection($query, string $name)
    {
        return $query->where('collection_name', $name);
    }
}