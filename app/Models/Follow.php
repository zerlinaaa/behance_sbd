<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follow extends Model
{
    protected $fillable = ['follower_id', 'following_id'];

    // ══════════════════════════════════════════════════
    // RELATIONSHIPS
    // ══════════════════════════════════════════════════

    /** User yang melakukan follow */
    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    /** User yang di-follow */
    public function following(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    // ══════════════════════════════════════════════════
    // BOOT — update followers_count & following_count
    // ══════════════════════════════════════════════════

    protected static function booted(): void
    {
        static::created(function(Follow $follow) {
            // Yang di-follow: naik followers_count
            User::where('id', $follow->following_id)
                ->increment('followers_count');
            // Yang follow: naik following_count
            User::where('id', $follow->follower_id)
                ->increment('following_count');
        });

        static::deleted(function(Follow $follow) {
            User::where('id', $follow->following_id)
                ->decrement('followers_count');
            User::where('id', $follow->follower_id)
                ->decrement('following_count');
        });
    }
}