<?php

namespace App\Console\Commands;

use App\Dispatch;
use App\Http\Controllers\DispatchController;
use Illuminate\Console\Command;

class RepairMissingDispatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:MissingDispatches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RepairMissingDispatches';

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
     * @return int
     */
    public function handle()
    {

        $files = scandir("C:/BL");
        foreach ($files as $file)
        {
            $filename = explode('.', $file);
            if(strlen($filename[0]) == 10)
            {
                $dispatch = Dispatch::where('name', '=', $filename[0])
                                    ->first();
                if(!$dispatch){
                    (new \App\Http\Controllers\DispatchController)->importBL($filename[0]);
                    $this->info($filename[0]);
                };
            };

        }

        return 0;
    }
}
