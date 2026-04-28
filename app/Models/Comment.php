<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'user_id', 'parent_id',
        'comment_text', 'is_approved',
    ];

    protected function casts(): array
    {
        return ['is_approved' => 'boolean'];
    }

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** Komentar ini ada di satu project */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /** Komentar ini ditulis oleh satu user */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Komentar induk (self-referencing) */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /** Balasan / reply dari komentar ini (self-referencing) */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')
                    ->with('user')              // eager load user di setiap reply
                    ->orderBy('created_at');
    }

    // ══════════════════════════════════════════════════
    // SCOPES
    // ══════════════════════════════════════════════════

    /** Hanya komentar yang sudah diapprove */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /** Hanya komentar root (bukan reply) */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }
}