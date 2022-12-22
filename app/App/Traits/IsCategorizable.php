<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Domains
use DDD\Domain\Categories\Category;

trait IsCategorizable
{
    protected static function bootIsCategorizable(): void
    {
        static::saving(function (Model $model) {
            if (request()->category) {
                $model->setCategory(request()->category);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setCategory($category)
    {
        if (!$category) {
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
