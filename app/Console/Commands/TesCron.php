<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class TesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
        $random ="AB".rand(100,999);
        \Log::info('ini jalan cuy');
        DB::table('tbl_tes')->insert([
            'isi' =>$random,
            'tgl' => date('Y-m-d H:i:s')
        ]);
        // DB::table('tbl_tes')->delete();
    }
}
