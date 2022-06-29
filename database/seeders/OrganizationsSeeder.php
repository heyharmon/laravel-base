<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Models
use DDD\Domain\Organizations\Organization;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = [
            ['title' => 'BloomCU'],
            ['title' => 'TFCU'],
            ['title' => 'CUSoCal'],
            ['title' => 'Lone Star'],
        ];

        foreach ($organizations as $organization) {
            Organization::create($organization);
        }
    }
}
