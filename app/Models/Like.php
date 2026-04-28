<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = ['project_id', 'user_id'];

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** Like ini untuk satu project */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /** Like ini dari satu user */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ══════════════════════════════════════════════════
    // BOOT — otomatis update likes_count di project
    // ══════════════════════════════════════════════════

    protected static function booted(): void
    {
        // Saat like dibuat, increment counter di project
        static::created(function(Like $like) {
            $like->project->increment('likes_count');
        });

        // Saat like dihapus, decrement counter
        static::deleted(function(Like $like) {
            $like->project->decrement('likes_count');
        });
    }
}