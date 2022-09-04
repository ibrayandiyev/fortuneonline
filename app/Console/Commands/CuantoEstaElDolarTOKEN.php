<?php

namespace App\Console\Commands;

use App\Http\Controllers\Control\CTipocambio;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CuantoEstaElDolarTOKEN extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cuanto-esta-el-dolar:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Token from cuantoestaeldolar.pe';

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
        Log::channel('cuanto_esta_el_dolar')->debug('*************************************************************************************');
        Log::channel('cuanto_esta_el_dolar')->debug("******** BEGIN COMMAND: 'cuanto-esta-el-dolar:token' ******** " . date('Y-m-d H:i:s'));
        try {
            if (!Cache::has('cuantoestaeldolar_token')) {
                $tipoCambioController = new CTipocambio();
                $token = $tipoCambioController->auth();
                Log::channel('cuanto_esta_el_dolar')->info("TOKEN: {$token}");
            }
            else {
                Log::channel('cuanto_esta_el_dolar')->info("Already has valid token");
            }
        } catch (Exception $e) {
            Log::channel('cuanto_esta_el_dolar')->error("ERROR: " . $e->getMessage());
        }
        Log::channel('cuanto_esta_el_dolar')->debug("******** END COMMAND: 'cuanto-esta-el-dolar:token' ******** " . date('Y-m-d H:i:s'));
        Log::channel('cuanto_esta_el_dolar')->debug('*************************************************************************************');
    }
}
