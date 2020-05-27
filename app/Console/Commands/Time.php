<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Time extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'time';

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
        exec('time', $output);
        foreach ($output as $value) {
            dump(iconv("EUC-KR","UTF-8", $value));
        }
    }
}
