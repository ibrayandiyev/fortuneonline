<?php

namespace App\Console\Commands;

use App\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeletePreferencial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preferencial:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'El comando eliminara aquellos tipos de cambio preferenciales en los que ya hayan pasado mas de 30 minutos.';

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
        Log::channel('delete_preferential')->debug('*************************************************************************************');
        Log::channel('delete_preferential')->debug("******** BEGIN COMMAND: 'preferencial:delete' ******** " . date('Y-m-d H:i:s'));

        try {
            $minutos_30 = 30*60;
            $preferenciales = DB::select('select * from tipocambio_aux');
            Log::channel('delete_preferential')->debug('Preferenciales: ' . count($preferenciales));

            $hora_actual = date('H');
            $minuto_actual = date('i');
            $segundos_actual = date('s');
            $segundos_totales = $hora_actual*3600 + $minuto_actual*60 + $segundos_actual;

            foreach($preferenciales as $preferencial){
                $hora_seteado = substr($preferencial->hora_seteado, 0, 2);
                $minuto_seteado = substr($preferencial->hora_seteado, 3, 2);
                $segundo_seteado = substr($preferencial->hora_seteado, 6, 2);

                $segundos_totales_seteado = $hora_seteado*3600 + $minuto_seteado*60 + $segundo_seteado;

                $diferencia = $segundos_totales - $segundos_totales_seteado;

                if($diferencia > $minutos_30){
                    Log::channel('delete_preferential')->debug('Eliminando preferencial de: ' . $preferencial->id_user);
                    $user = User::find($preferencial->id_user);
                    $user->regdate = null;
                    $user->timestamp = null;
                    $user->previous_visit = null;
                    $user->save();

                    $deleted = DB::delete('delete from tipocambio_aux where id='.$preferencial->id);
                    Log::channel('delete_preferential')->debug('Preferencial de ' . $preferencial->id_user . ' eliminado: ' . $deleted);
                }
            }
        } catch (Exception $e) {
            Log::channel('delete_preferential')->error('Exception: ' . $e->getMessage());
        }
        

        Log::channel('delete_preferential')->debug('*************************************************************************************');
        Log::channel('delete_preferential')->debug("******** END COMMAND: 'preferencial:delete' ******** " . date('Y-m-d H:i:s'));
    }
}
