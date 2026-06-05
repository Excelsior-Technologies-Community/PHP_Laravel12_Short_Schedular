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
        try {
            if (rand(1, 5) === 3) {
                throw new \Exception('Random failure occurred');
            }

            Log::create([
                'message' => 'Executed at ' . now(),
                'status' => 'success'
            ]);

            $this->info('Success at ' . now());

        } catch (\Exception $e) {
            Log::create([
                'message' => $e->getMessage(),
                'status' => 'failed'
            ]);

            $this->error('Failed: ' . $e->getMessage());
        }
    }
}