<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

require_once './vendor/autoload.php';
use App\ZohoAccounts;

class syncZohoAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:zoho:accounts';

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
		$zohoaccounts = new ZohoAccounts;
		
		$zohoaccounts->getZohoAccounts();
		
        $this->info('Zoho Accounts Synchronized Successfully');
    }
}
