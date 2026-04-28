<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, BelongsToMany};

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'cover_image',
        'slug', 'status', 'views_count', 'likes_count', 'comments_count',
    ];

    protected function casts(): array
    {
        return ['created_at' => 'datetime'];
    }

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** Project dimiliki oleh satu User (N:1) */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Project punya banyak gambar (1:N) */
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)
                    ->orderBy('sort_order');
    }

    /** Project punya banyak komentar (1:N) */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)
                    ->whereNull('parent_id')  // hanya komentar utama
                    ->orderByDesc('created_at');
    }

    /** Semua komentar termasuk reply */
    public function allComments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /** Project punya banyak likes (1:N) */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /** Project punya banyak bookmarks (1:N) */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /** Project masuk banyak kategori (N:M lewat project_categories) */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'project_categories'  // nama tabel pivot
        )->withTimestamps();
    }

    // ══════════════════════════════════════════════════
    // ACCESSORS
    // ══════════════════════════════════════════════════

    /** URL halaman detail project */
    public function getUrlAttribute(): string
    {
        return route('projects.show', $this->slug);
    }

    /** Cover image dengan fallback */
    public function getCoverUrlAttribute(): string
    {
        return $this->cover_image
            ?? 'https://picsum.photos/seed/' . $this->id . '/800/600';
    }

    // ══════════════════════════════════════════════════
    // HELPER METHODS
    // ══════════════════════════════════════════════════

    /** Cek apakah user tertentu sudah like project ini */
    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    /** Cek apakah user sudah bookmark project ini */
    public function isBookmarkedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }

    /** Tambah view count (+1) */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    // ══════════════════════════════════════════════════
    // SCOPES
    // ══════════════════════════════════════════════════

    /** Hanya project yang published */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /** Urutkan dari yang paling banyak likes */
    public function scopeTrending($query, int $days = 30)
    {
        return $query
            ->published()
            ->where('created_at', '>=', now()->subDays($days))
            ->orderByDesc('likes_count');
    }

    /** Filter berdasarkan kategori */
    public function scopeInCategory($query, int|string $category)
    {
        return $query->whereHas('categories', fn($q) =>
            $q->where(is_int($category) ? 'id' : 'slug', $category)
        );
    }

    /** Pencarian full-text */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where(fn($q) =>
            $q->where('title', 'like', "%{$keyword}%")
               ->orWhere('description', 'like', "%{$keyword}%")
        );
    }
}