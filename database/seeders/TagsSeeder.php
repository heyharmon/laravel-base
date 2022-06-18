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
                'title' => 'Content Categories',
            ],
            [
                'title' => 'Accounts',
                'parent_id' => 1,
            ],
            [
                'title' => 'Checking',
                'parent_id' => 2,
            ],
            [
                'title' => 'Savings',
                'parent_id' => 2,
            ],
            [
                'title' => 'Share',
                'parent_id' => 4,
            ],
            [
                'title' => 'Money Market',
                'parent_id' => 4,
            ],
            [
                'title' => 'Certificates',
                'parent_id' => 4,
            ],
            [
                'title' => 'Loans',
                'parent_id' => 1,
            ],
            [
                'title' => 'Cards',
                'parent_id' => 1,
            ],
            [
                'title' => 'Content Types',
            ],
            [
                'title' => 'Product',
                'parent_id' => 10,
            ],
            [
                'title' => 'Service',
                'parent_id' => 10,
            ],
            [
                'title' => 'Info',
                'parent_id' => 10,
            ],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
