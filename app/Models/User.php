<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasMany, BelongsToMany};
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'username', 'email', 'password',
        'bio', 'avatar', 'location', 'website', 'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** User punya banyak project (1:N) */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /** User punya banyak komentar */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /** User punya banyak likes */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /** User punya banyak bookmarks */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /** Siapa saja yang follow user ini (self-ref N:M lewat follows) */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follows',          // pivot table
            'following_id',     // FK kolom ini di pivot
            'follower_id'       // FK user lain di pivot
        )->withTimestamps();
    }

    /** User ini follow siapa saja */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'follower_id',      // FK kolom ini di pivot
            'following_id'      // FK user lain di pivot
        )->withTimestamps();
    }

    // ══════════════════════════════════════════════════
    // ACCESSORS
    // ══════════════════════════════════════════════════

    /** Nama lengkap atau username jika nama kosong */
    public function getDisplayNameAttribute(): string
    {
        return $this->name ?: '@' . $this->username;
    }

    /** URL avatar dengan fallback ke UI Avatars */
    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }

    // ══════════════════════════════════════════════════
    // HELPER METHODS
    // ══════════════════════════════════════════════════

    /** Cek apakah user ini sudah follow $user */
    public function isFollowing(User $user): bool
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    /** Cek apakah user adalah admin */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // ══════════════════════════════════════════════════
    // SCOPES
    // ══════════════════════════════════════════════════

    /** Hanya tampilkan admin */
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    /** User paling banyak follower-nya */
    public function scopeTopCreators($query, int $limit = 10)
    {
        return $query
            ->orderByDesc('followers_count')
            ->limit($limit);
    }
}