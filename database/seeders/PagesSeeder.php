<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        // $now = now();

        $pages = [
            [
                'site_id' => 1,
                'status' => '200',
                'title' => 'Blank Page Blueprint',
                'url' => 'https://google.com',
                'wordcount' => 3000,
                // 'created_at' => $now->addSecond()->toDateTimeString(),
            ],
            [
                'site_id' => 1,
                'status' => '200',
                'title' => 'Homepage',
                'url' => 'https://google.com',
                'wordcount' => 3000,
                // 'created_at' => $now->addSecond()->toDateTimeString(),
            ],
            [
                'site_id' => 1,
                'status' => '200',
                'title' => 'Checking',
                'url' => 'https://google.com',
                'wordcount' => 3000,
                // 'created_at' => $now->addSecond()->toDateTimeString(),
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
