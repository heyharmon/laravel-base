<?php

namespace DDD\App\Console\Commands;

use Illuminate\Console\Command;

use DDD\Domain\Base\Users\User;

class CountUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count total number of users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $count = User::count();

        $this->info('Total users: ' . $count);
    }
}
