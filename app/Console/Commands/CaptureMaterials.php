<?php

namespace App\Console\Commands;

use App\Libraries\WebCapture;
use Illuminate\Console\Command;

class CaptureMaterials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:capture';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        $webCapture = new WebCapture();
        $webCapture->run($this);
    }
}
