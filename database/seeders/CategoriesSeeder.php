<?php

namespace Database\Seeders;

use DDD\Domain\Base\Categories\Category;
// Models
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'title' => 'Page Categories',
            ],
            [
                'id' => 2,
                'title' => 'Accounts',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Checking',
                'parent_id' => 2,
            ],
            [
                'id' => 4,
                'title' => 'Savings',
                'parent_id' => 2,
            ],
            [
                'id' => 5,
                'title' => 'Share',
                'parent_id' => 4,
            ],
            [
                'id' => 6,
                'title' => 'Money Market',
                'parent_id' => 4,
            ],
            [
                'id' => 7,
                'title' => 'Certificates',
                'parent_id' => 4,
            ],
            [
                'id' => 8,
                'title' => 'Retirement',
                'parent_id' => 4,
            ],
            [
                'id' => 9,
                'title' => 'Education',
                'parent_id' => 4,
            ],
            [
                'id' => 10,
                'title' => 'Trust',
                'parent_id' => 4,
            ],
            [
                'id' => 11,
                'title' => 'Estate',
                'parent_id' => 4,
            ],
            [
                'id' => 12,
                'title' => 'Health',
                'parent_id' => 4,
            ],
            [
                'id' => 13,
                'title' => 'Loans',
                'parent_id' => 1,
            ],
            [
                'id' => 14,
                'title' => 'Vehicle',
                'parent_id' => 13,
            ],
            [
                'id' => 15,
                'title' => 'Home',
                'parent_id' => 13,
            ],
            [
                'id' => 16,
                'title' => 'Mortgage',
                'parent_id' => 15,
            ],
            [
                'id' => 17,
                'title' => 'Home Equity',
                'parent_id' => 15,
            ],
            [
                'id' => 18,
                'title' => 'Personal',
                'parent_id' => 13,
            ],
            [
                'id' => 19,
                'title' => 'Student',
                'parent_id' => 13,
            ],
            [
                'id' => 20,
                'title' => 'Cards',
                'parent_id' => 1,
            ],
            [
                'id' => 21,
                'title' => 'Credit',
                'parent_id' => 20,
            ],
            [
                'id' => 22,
                'title' => 'Debit',
                'parent_id' => 20,
            ],
            [
                'id' => 23,
                'title' => 'Prepaid',
                'parent_id' => 20,
            ],
            [
                'id' => 24,
                'title' => 'Services',
                'parent_id' => 1,
            ],
            [
                'id' => 25,
                'title' => 'Investment',
                'parent_id' => 24,
            ],
            [
                'id' => 26,
                'title' => 'Insurance',
                'parent_id' => 24,
            ],
            [
                'id' => 27,
                'title' => 'Notary',
                'parent_id' => 24,
            ],
            [
                'id' => 28,
                'title' => 'Planning',
                'parent_id' => 24,
            ],
            [
                'id' => 29,
                'title' => 'Resources',
                'parent_id' => 1,
            ],
            [
                'id' => 30,
                'title' => 'Education',
                'parent_id' => 29,
            ],
            [
                'id' => 31,
                'title' => 'Calculators',
                'parent_id' => 29,
            ],
            [
                'id' => 32,
                'title' => 'Classifieds',
                'parent_id' => 29,
            ],
            [
                'id' => 33,
                'title' => 'Online & Mobile',
                'parent_id' => 1,
            ],
            [
                'id' => 34,
                'title' => 'Online',
                'parent_id' => 33,
            ],
            [
                'id' => 35,
                'title' => 'Mobile',
                'parent_id' => 33,
            ],
            [
                'id' => 36,
                'title' => 'Business',
                'parent_id' => 1,
            ],
            [
                'id' => 37,
                'title' => 'Accounts',
                'parent_id' => 36,
            ],
            [
                'id' => 38,
                'title' => 'Checking',
                'parent_id' => 37,
            ],
            [
                'id' => 39,
                'title' => 'Savings',
                'parent_id' => 37,
            ],
            [
                'id' => 40,
                'title' => 'Loans',
                'parent_id' => 36,
            ],
            [
                'id' => 41,
                'title' => 'SBA',
                'parent_id' => 40,
            ],
            [
                'id' => 42,
                'title' => 'Line of Credit',
                'parent_id' => 40,
            ],
            [
                'id' => 43,
                'title' => 'Vehicle',
                'parent_id' => 40,
            ],
            [
                'id' => 44,
                'title' => 'Real Estate',
                'parent_id' => 40,
            ],
            [
                'id' => 45,
                'title' => 'Cards',
                'parent_id' => 36,
            ],
            [
                'id' => 46,
                'title' => 'Credit',
                'parent_id' => 45,
            ],
            [
                'id' => 47,
                'title' => 'Debit',
                'parent_id' => 45,
            ],
            [
                'id' => 48,
                'title' => 'Services',
                'parent_id' => 36,
            ],
            [
                'id' => 49,
                'title' => 'Investment',
                'parent_id' => 48,
            ],
            [
                'id' => 50,
                'title' => 'Insurance',
                'parent_id' => 48,
            ],
            [
                'id' => 51,
                'title' => 'Resources',
                'parent_id' => 36,
            ],
            [
                'id' => 52,
                'title' => 'Education',
                'parent_id' => 51,
            ],
            [
                'id' => 53,
                'title' => 'Calculators',
                'parent_id' => 51,
            ],
            [
                'id' => 54,
                'title' => 'Online & Mobile',
                'parent_id' => 36,
            ],
            [
                'id' => 55,
                'title' => 'Online',
                'parent_id' => 54,
            ],
            [
                'id' => 56,
                'title' => 'Mobile',
                'parent_id' => 54,
            ],
            [
                'id' => 57,
                'title' => 'About',
                'parent_id' => 1,
            ],
            [
                'id' => 58,
                'title' => 'Who We Are',
                'parent_id' => 57,
            ],
            [
                'id' => 59,
                'title' => 'Contact',
                'parent_id' => 57,
            ],
            [
                'id' => 60,
                'title' => 'Location',
                'parent_id' => 59,
            ],
            [
                'id' => 61,
                'title' => 'ATM',
                'parent_id' => 59,
            ],
            [
                'id' => 62,
                'title' => 'Community',
                'parent_id' => 57,
            ],
            [
                'id' => 63,
                'title' => 'Membership',
                'parent_id' => 57,
            ],
            [
                'id' => 64,
                'title' => 'Blog',
                'parent_id' => 57,
            ],
            [
                'id' => 65,
                'title' => 'News',
                'parent_id' => 57,
            ],
            [
                'id' => 66,
                'title' => 'Careers',
                'parent_id' => 57,
            ],
            [
                'id' => 67,
                'title' => 'Help',
                'parent_id' => 1,
            ],
            [
                'id' => 68,
                'title' => 'FAQs',
                'parent_id' => 67,
            ],
            [
                'id' => 69,
                'title' => 'Legal',
                'parent_id' => 1,
            ],
            [
                'id' => 70,
                'title' => 'Homepage',
                'parent_id' => 1,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
