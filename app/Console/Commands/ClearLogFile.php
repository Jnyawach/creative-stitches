<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear log file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        exec('echo "" > ' . storage_path('logs/laravel.log'));
        $this->info('Logs have been cleared');
    }
}
