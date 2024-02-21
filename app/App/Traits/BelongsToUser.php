<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::creating(function (Model $model) {
            if ($user = request()->user()) {
                $model->user_id = request()->user()->id;
            }
        });
    }

    /**
     * User this model belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\DDD\Domain\Base\Users\User::class);
    }
}
