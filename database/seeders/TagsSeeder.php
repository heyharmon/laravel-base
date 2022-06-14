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
        $tags = ['Tag One', 'Tag Two', 'Tag Three'];

        foreach ($tags as $tag) {
            Tag::create(['title' => $tag]);
        }
    }
}
