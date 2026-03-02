<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Log;

class EverySecondCommand extends Command
{
    protected $signature = 'demo:every-second';
    protected $description = 'Run task every second';

    public function handle()
    {
        Log::create([
            'message' => 'Executed at ' . now()
        ]);

        $this->info('Command executed at ' . now());
    }
}
