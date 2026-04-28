<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'image_path', 'caption',
        'sort_order', 'mime_type', 'file_size',
    ];

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** Gambar ini milik satu project */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // ══════════════════════════════════════════════════
    // ACCESSORS
    // ══════════════════════════════════════════════════

    /** Ukuran file dalam format manusiawi (KB/MB) */
    public function getFileSizeHumanAttribute(): string
    {
        if (!$this->file_size) return '—';
        return $this->file_size < 1048576
            ? round($this->file_size / 1024, 1) . ' KB'
            : round($this->file_size / 1048576, 1) . ' MB';
    }

    // ══════════════════════════════════════════════════
    // SCOPES
    // ══════════════════════════════════════════════════

    /** Ambil gambar cover (sort_order terendah) */
    public function scopeCover($query)
    {
        return $query->orderBy('sort_order')->limit(1);
    }
}