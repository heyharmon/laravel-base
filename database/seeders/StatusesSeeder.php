<?php

namespace Database\Seeders;

use DDD\Domain\Base\Statuses\Status;
// Models
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 1,
                'title' => 'Page Status',
            ],
            [
                'id' => 2,
                'title' => 'Needs Review',
                'parent_id' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Looks Good',
                'parent_id' => 1,
            ],
            [
                'id' => 4,
                'title' => 'Not Sure',
                'parent_id' => 1,
            ],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
