<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearAbandonedOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears abandoned orders';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $orders=Order::where('created_at','<',Carbon::today()->subDays(5))
       ->where('status','Pending')->delete();


    }
}
