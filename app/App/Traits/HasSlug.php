<?php

namespace DDD\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            if (! $model->slug) {
                $slug = Str::slug($model->title);
                $model->slug = $model->generateUniqueSlug($slug);
            }
        });

        // TODO: After "updated" event, we might check that the slug is still unique
        // static::updated(function (Model $model) {});
    }

    protected function generateUniqueSlug(string $slug): string
    {
        $originalSlug = $slug;
        $counter = 2;

        while ($this->slugExists($slug)) {
            $slug = $originalSlug.'-'.$counter++;
        }

        return $slug;
    }

    protected function slugExists(string $slug): bool
    {
        $query = (new self)->where('slug', '=', $slug);

        if ($this->usesSoftDeletes()) {
            $query->withTrashed();
        }

        return $query->exists();
    }

    protected function usesSoftDeletes(): bool
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($this), true);
    }
}
