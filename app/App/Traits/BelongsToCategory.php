<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use DDD\Domain\Categories\Category;

trait BelongsToCategory
{
    protected static function bootBelongsToCategory(): void
    {
        // static::creating(function (Model $model) {
        //     if (request()->category) {
        //         $category = Category::find(request()->category);
        //         $model->associate($category);
        //     }
        // });
    }

    /**
     * Category this model belongs to.
     *
     * @return belongsTo
     */
    public function category()
    {
        return $this->belongsTo('DDD\Domain\Categories\Category');
    }
}
