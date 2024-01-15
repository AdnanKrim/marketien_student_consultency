<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserOtp;

class DeleteOtp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'previous otp cleared';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        UserOtp::where('created_at', '<', now()->subMinutes(3))->delete();
        $this->info('old otp cleared');
        
    }
}
