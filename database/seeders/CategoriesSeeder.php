<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// Models
use DDD\Domain\Categories\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'title' => 'Page Categories',
            ],
                [
                    'id' => 2,
                    'title' => 'Accounts',
                    'parent_id' => 1,
                ],
                [
                    'id' => 3,
                    'title' => 'Checking',
                    'parent_id' => 2,
                ],
                [
                    'id' => 4,
                    'title' => 'Savings',
                    'parent_id' => 2,
                ],
                [
                    'id' => 5,
                    'title' => 'Share',
                    'parent_id' => 4,
                ],
                [
                    'id' => 6,
                    'title' => 'Money Market',
                    'parent_id' => 4,
                ],
                [
                    'id' => 7,
                    'title' => 'Certificates',
                    'parent_id' => 4,
                ],
                [
                    'id' => 8,
                    'title' => 'Loans',
                    'parent_id' => 1,
                ],
                [
                    'id' => 9,
                    'title' => 'Cards',
                    'parent_id' => 1,
                ],
            [
                'id' => 10,
                'title' => 'Page Types',
            ],
                [
                    'id' => 11,
                    'title' => 'Product',
                    'parent_id' => 10,
                ],
                [
                    'id' => 12,
                    'title' => 'Service',
                    'parent_id' => 10,
                ],
                [
                    'id' => 13,
                    'title' => 'Info',
                    'parent_id' => 10,
                ],
            [
                'id' => 14,
                'title' => 'Media Categories',
            ],
                [
                    'id' => 15,
                    'title' => 'Brand',
                    'parent_id' => 14,
                ],
                [
                    'id' => 16,
                    'title' => 'Logo',
                    'parent_id' => 14,
                ],
                [
                    'id' => 17,
                    'title' => 'Font',
                    'parent_id' => 14,
                ],
                [
                    'id' => 18,
                    'title' => 'Photo',
                    'parent_id' => 14,
                ],
                [
                    'id' => 19,
                    'title' => 'Other',
                    'parent_id' => 14,
                ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
