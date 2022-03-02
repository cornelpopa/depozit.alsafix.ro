<?php

namespace App\Console\Commands;

use App\Dispatch;
use App\SaleUnit;
use Illuminate\Console\Command;

class repairSalesUnitOnDispatchElement extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repair:salesUnitOnDispatchElement';

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
     * @return int
     */
    public function handle()
    {

        $saleUnits = SaleUnit::get(['id', 'name']);

        $dispatches = Dispatch::where('dispatchDate', '>', '2021-09-31')
                              ->with('elements')
                              ->orderBy('id')
                              ->get();
        $bar = $this->output->createProgressBar(count($dispatches));
        $bar->start();

        foreach ($dispatches as $dispatch) {
            $oldFile = 'C:/BL/'.$dispatch->name.'.csv';
            $rows = array_map(function ($v) {
                return str_getcsv($v, ";");
            }, file($oldFile));

            if (count($rows)) {
                foreach ($rows as $row)
                {
                    $sku = $row[7];
                    $dispatchElement = $dispatch->elements->where('sku', '=', $sku)
                                                          ->first();
                    $correctSaleUnitId = $saleUnits->firstWhere('name', '=', $row[12])->id;
                    if($correctSaleUnitId <> $dispatchElement->sale_unit_id){
                        $dispatchElement->sale_unit_id = $correctSaleUnitId;
                        $dispatchElement->  save(['touch' => false]);
                    }
                }
            }

            $bar->advance();

        }

        return 0;
    }
}
