<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Product;
use Customer;
use Order;

class Woocomerce extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'woo:oh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dd(Product::all()->toArray());
        echo ":)";
        return Command::SUCCESS;
    }
}
