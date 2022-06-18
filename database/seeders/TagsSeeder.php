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
        $tags = [
            [
                'title' => 'Parent One',
            ],
            [
                'title' => 'Child One',
                'parent_id' => 1,
            ],
            [
                'title' => 'Grandchild One',
                'parent_id' => 2,
            ],
            [
                'title' => 'Parent Two',
            ],
            [
                'title' => 'Parent Three',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
