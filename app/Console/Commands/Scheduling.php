<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utility\WeekScheduling;
use Illuminate\Support\Facades\Log;
use App\User;

class Scheduling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduling';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("Generating week");
        
        User::chunk(5, function($users) {
            foreach ($users as $user) {
                $scheduling = new WeekScheduling($user);
                $scheduling->generateWeek();
            }
        });
    }

    
}
