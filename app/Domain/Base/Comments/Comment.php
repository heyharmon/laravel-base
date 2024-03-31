<?php

namespace DDD\Domain\Base\Comments;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'user_id',
        'taggable_id',
        'taggable_type',
    ];

    // TODO: Use the BelongsToUser Trait
    public function user(): BelongsTo
    {
        return $this->belongsTo(\DDD\Domain\Base\Users\User::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(\DDD\Domain\Base\Comments\Comment::class, 'parent_id', 'id');
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}
