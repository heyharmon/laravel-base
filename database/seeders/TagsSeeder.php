<?php

namespace Database\Seeders;

use DDD\Domain\Tags\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'title' => 'Tag One',
            ],
            [
                'title' => 'Child Tag One',
                'parent_id' => 1,
            ],
            [
                'title' => 'Tag Two',
            ],
            [
                'title' => 'Tag Three',
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
