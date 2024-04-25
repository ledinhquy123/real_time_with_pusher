<?php

namespace App\Console\Commands;

use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    private $time = 15;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start run game';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        while(true) {
            if($this->time < 0) break;
            if($this->time === 0) {
                broadcast(new RemainingTimeChanged('Please wait to start'));
                broadcast(new WinnerNumberGenerated(mt_rand(1, 12)));

                $this->time = 15;
                sleep(5);
            }
            broadcast(new RemainingTimeChanged($this->time.'s'));
            $this->time--;
            sleep(1);
        }
    }
}
