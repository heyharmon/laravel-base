<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Domains
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
        Organization::create([
            'title' => 'BloomCU',
        ]);

        $faker = \Faker\Factory::create();

        foreach (range(1, 2) as $i) {
            Organization::create([
                'title' => $faker->company,
            ]);
        }
    }
}
