<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \DDD\Domain\Base\Users\User::factory(1)->create();

        $this->call([
            // CategoriesSeeder::class,
            SubscriptionPlansSeeder::class,
            OrganizationsSeeder::class,
            TagsSeeder::class,
            StatusesSeeder::class,
        ]);
    }
}
