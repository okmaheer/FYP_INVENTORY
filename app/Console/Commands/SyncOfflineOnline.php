<?php

namespace App\Console\Commands;

use App\Models\InternetStatus;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncOfflineOnline extends Command
{

    public $status = null;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:offline_online';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync offline and online';

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
        /*$final_array = [];
        $lastStatus = InternetStatus::whereIsSynced(false)->get();
        if (count($lastStatus) > 0) {
            $this->info(print_r($final_array));
        }*/

        $this->info(print_r(Transaction::all()));
        $this->info(DB::connection('local-database')->statement('select * from transactions'));
    }
}
