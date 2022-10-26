<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Customer;

class getCustomerCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getCustomerCount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '顧客数の集計';

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
        Log::info('--- getCustomerCount Start ---');

        try {
            $file = "public/getCustomerCount.json";
            file_put_contents($file, []); 
            $customerCount = Customer::getCustomerCount();
            $customerCount = json_encode($customerCount , JSON_UNESCAPED_UNICODE);
            file_put_contents($file, $customerCount);
        } catch (Exception $e) {
            log::info(var_export($e, true));
        }
        
        Log::info('--- getCustomerCount End ---');
    }
}
