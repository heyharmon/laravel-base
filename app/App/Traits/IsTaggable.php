<?php

namespace DDD\App\Traits;

use DDD\App\Scopes\TaggableScopes;
use DDD\Domain\Base\Tags\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
// Models
use Illuminate\Support\Collection;
// Scopes
use Illuminate\Support\Str;

trait IsTaggable
{
    use TaggableScopes;

    protected static function bootIsTaggable(): void
    {
        static::created(function (Model $model) {
            if (request()->tags) {
                $model->tag(request()->tags);
            }
        });
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tag($tags)
    {
        $this->addTags($this->getWorkableTags($tags));
    }

    public function untag($tags = null)
    {
        if ($tags === null) {
            $this->removeAllTags();

            return;
        }

        $this->removeTags($this->getWorkableTags($tags));
    }

    public function retag($tags)
    {
        $this->removeAllTags();

        $this->tag($tags);
    }

    private function addTags(Collection $tags)
    {
        $sync = $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        // Increment tagged counts
        foreach (Arr::get($sync, 'attached') as $attachedId) {
            $tags->where('id', $attachedId)->first()->increment('tagged_count');
        }
    }

    private function removeTags(Collection $tags)
    {
        $this->tags()->detach($tags);

        // Decrement tagged counts
        foreach ($tags->where('tagged_count', '>', 0) as $tag) {
            $tag->decrement('tagged_count');
        }
    }

    private function removeAllTags()
    {
        $this->removeTags($this->tags);
    }

    private function getWorkableTags($tags)
    {
        // String
        if (is_string($tags)) {
            return $this->getTagModel($tags);
        }

        // Array of tags
        if (is_array($tags)) {
            return $this->getTagModels($tags);
        }

        // Tag model
        if ($tags instanceof Model) {
            return $this->getTagModels($tags->slug);
        }

        // Collection of tags
        return $this->filterTagsCollection($tags);
    }

    private function getTagModel(string $tag)
    {
        return Tag::where('slug', Str::slug($tag))->get();
    }

    private function getTagModels(array $tags)
    {
        return Tag::whereIn('slug', $this->getSluggifiedTagName($tags))->get();
    }

    private function getSluggifiedTagName(array $tags)
    {
        return array_map(function ($tag) {
            return Str::slug($tag);
        }, $tags);
    }

    private function filterTagsCollection(Collection $tags)
    {
        // Filter out tags that don't exist
        return $tags->filter(function ($tag) {
            return $tag instanceof Model;
        });
    }
}
