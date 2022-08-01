<?php

namespace App\Console\Commands;

use App\Traits\InvoiceProvider;
use Illuminate\Console\Command;

class AutoBilling extends Command
{
    use InvoiceProvider;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'billing:start';

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
        $this->checkForExpiredInvoices();
        return 0;
    }
}
