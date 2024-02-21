<?php

namespace Database\Seeders;

use DDD\Domain\Base\Subscriptions\Plans\Plan;
// Models
use Illuminate\Database\Seeder;

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'title' => 'Free Plan',
                'price' => 0,
                'interval' => '',
                'buyable' => false,
                'limits' => [
                    'users' => 1,
                    'rates' => 100,
                ],
                'stripe_price_id' => '',
            ],
            [
                'title' => 'Basic - Monthly',
                'price' => 2900,
                'interval' => 'month',
                'buyable' => true,
                'limits' => [
                    'users' => 5,
                    'rates' => 500,
                ],
                'stripe_price_id' => 'price_1MWbZ9EmdmUz6fowjogVHvQg',
            ],
            [
                'title' => 'Basic - Yearly',
                'price' => 29900,
                'interval' => 'year',
                'buyable' => true,
                'limits' => [
                    'users' => 5,
                    'rates' => 500,
                ],
                'stripe_price_id' => 'price_1MWbZ9EmdmUz6fowIDvZWRtz',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
