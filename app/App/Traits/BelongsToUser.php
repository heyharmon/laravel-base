<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

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
     *
     * @return belongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\DDD\Domain\Base\Users\User::class);
    }
}
