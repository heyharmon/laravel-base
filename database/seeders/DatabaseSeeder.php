<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \DDD\Domain\Users\User::factory(1)->create();

        $this->call([
            // CategoriesSeeder::class,
            OrganizationsSeeder::class,
            UsersSeeder::class,
            SitesSeeder::class,
            PagesSeeder::class,
            TagsSeeder::class,
            StatusesSeeder::class,
        ]);
    }
}
