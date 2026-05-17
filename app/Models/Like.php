<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $fillable = ['project_id', 'user_id'];

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
}