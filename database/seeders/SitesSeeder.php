<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Models
use DDD\Domain\Sites\Site;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
