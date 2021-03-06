<?php

namespace App\Console\Commands;

use Cache;
use Illuminate\Console\Command;

class ApiGameNextTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:result';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lay Thoi Gian va ket Qua cua lan ke tiep';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Begin...');
        Cache::forget('Powerball');
        $powerball = powerballNextTime();
        print_r($powerball);

        Cache::forget('Mega Millions');
        $mega = megaNextTime();
        print_r($mega);
        $this->info('End!');
    }
}
