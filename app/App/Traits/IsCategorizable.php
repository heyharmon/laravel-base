<?php

namespace DDD\App\Traits;

use DDD\Domain\Base\Categories\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Models
use Illuminate\Support\Str;

trait IsCategorizable
{
    protected static function bootIsCategorizable(): void
    {
        static::creating(function (Model $model) {
            if (! $model->category_id) {
                $model->setCategory('uncategorized');
            }
        });

        static::saving(function (Model $model) {
            if (request()->category) {
                $model->setCategory(request()->category);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function setCategory($category)
    {
        if (! $category) {
            $this->category()->dissociate();

            return;
        }

        $this->category()->associate(
            $this->getWorkableCategory($category)
        );
    }

    private function getWorkableCategory($category)
    {
        // String
        if (is_string($category)) {
            return $this->getCategoryModel($category);
        }

        // Integer
        if (is_int($category)) {
            return Category::find($category);
        }

        // Model
        if ($category instanceof Model) {
            return $category;
        }
    }

    private function getCategoryModel(string $category)
    {
        return Category::where('slug', Str::slug($category))->first();
    }
}
