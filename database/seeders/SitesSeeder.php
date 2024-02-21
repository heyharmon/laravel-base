<?php

namespace Database\Seeders;

use DDD\Domain\Base\Sites\Site;
// Models
use Illuminate\Database\Seeder;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Site::create([
            'organization_id' => 1,
            'title' => 'Primary Website',
            'url' => 'https://model.bloomcudev.com',
            'domain' => 'model.bloomcudev.com',
            'scheme' => 'https',
        ]);
    }
}
