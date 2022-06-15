<?php

namespace DDD\App\Traits;

use DDD\Domain\Tags\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

trait IsTaggable
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tag($tags)
    {
        $this->addTags(
            $this->getWorkableTags($tags)
        );
    }

    private function addTags(Collection $tags) {
        $sync = $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        // Increment count for each tag used
        foreach(Arr::get($sync, 'attached') as $attachedId) {
            $tags->where('id', $attachedId)->first()->increment('count');
        }
    }

    private function getWorkableTags($tags)
    {
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

    private function getTagModels(array $tags)
    {
        return Tag::whereIn('slug', $this->getSluggifiedTagName($tags))->get();
    }

    private function getSluggifiedTagName(array $tags)
    {
        return array_map(function($tag) {
            return Str::slug($tag);
        }, $tags);
    }

    private function filterTagsCollection(Collection $tags)
    {
        // Filter out tags that don't exist
        return $tags->filter(function($tag) {
            return $tag instanceof Model;
        });
    }
}
