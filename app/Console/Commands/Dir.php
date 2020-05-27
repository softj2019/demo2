<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Dir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dir/w';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dir/w';

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
        exec('dir/w', $output);
        foreach ($output as $value) {
            echo(iconv("EUC-KR","UTF-8", $value));
        }
    }
}
