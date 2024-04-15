<?php

namespace Database\Seeders;

use DDD\Domain\Base\Organizations\Organization;
// Models
use Illuminate\Database\Seeder;

class LocalOrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = [
            ['title' => 'Acme'],
        ];

        foreach ($organizations as $organization) {
            Organization::create($organization);
        }
    }
}
