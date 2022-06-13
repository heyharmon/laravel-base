<?php

namespace Database\Seeders;

use DDD\Domain\Sites\Site;
use Illuminate\Database\Seeder;

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
            'start_url' => 'https://bloomcu.com',
            'host' => 'bloomcu.com',
            'scheme' => 'https',
        ]);
    }
}
