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
            'start_url' => 'https://www.getsuperflow.co',
            'host' => 'www.getsuperflow.co',
            'scheme' => 'https',
        ]);
    }
}
