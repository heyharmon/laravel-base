<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Models
use DDD\Domain\Designs\Design;

class DesignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Design::create([
            'organization_id' => 1,
            'title' => 'Design #1',
            'designer' => 'Ryan Harmon',
            'variables' => [
                'color_primary' => '#ffffff',
                'color_accent' => '#000000',
            ],
        ]);
    }
}
