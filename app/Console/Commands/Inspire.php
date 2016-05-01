<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Http\Controllers\AdInfoController;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Starting Refresh Ad RPM";
        $AdInfo = new AdInfoController();
        $output = $AdInfo->refresh();
        echo str_replace(array('<br />','<hr>','</p>','<p>')," \n ",$output); //formatting output for terminal
        echo "\n Done Refresh Ad RPM";
        // $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
