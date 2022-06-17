<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// Domains
use DDD\Domain\Tags\TagGroup;
use DDD\Domain\Tags\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagGroups = [
            [
                'title' => 'Tag Group',
            ]
        ];

        foreach ($tagGroups as $group) {
            TagGroup::create($group);
        }

        $tags = [
            [
                'title' => 'Tag One',
                'tag_group_id' => 1,
            ],
            [
                'title' => 'Child Tag One',
                'tag_group_id' => 1,
                'parent_id' => 1,
            ],
            [
                'title' => 'Tag Two',
                'tag_group_id' => 1,
            ],
            [
                'title' => 'Tag Three',
                'tag_group_id' => 1,
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
