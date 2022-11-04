<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Models
use DDD\Domain\Pages\Page;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'user_id' => 1,
                'site_id' => 1,
                'http_status' => '200',
                'title' => 'About',
                'url' => 'https://google.com',
                'wordcount' => 3000,
            ],
            [
                'user_id' => 1,
                'site_id' => 1,
                'http_status' => '200',
                'title' => 'Checking',
                'url' => 'https://google.com',
                'wordcount' => 3000,
            ],
            [
                'user_id' => 1,
                'site_id' => 1,
                'http_status' => '200',
                'title' => 'Homepage',
                'url' => 'https://google.com',
                'wordcount' => 3000,
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
