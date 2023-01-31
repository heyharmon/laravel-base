<?php

namespace DDD\Domain\Base\Comments;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function user()
    {
        return $this->belongsTo('DDD\Domain\Base\Users\User');
    }

    public function children()
    {
        return $this->hasMany('DDD\Domain\Base\Comments\Comment', 'parent_id', 'id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
