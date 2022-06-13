<?php

namespace Database\Seeders;

use DDD\Domain\Organizations\Organization;
use Illuminate\Database\Seeder;

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
    }
}
