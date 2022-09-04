<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class BalanceReportExport implements FromView
{
    public function view(): View
    {
        $initial_box_pen = floatval(Cache::get('initial_box_pen', '0'));
        $initial_box_dol = floatval(Cache::get('initial_box_dol', '0'));
        $exchange_rate = \App\Modelo\Tipocambio::where('created_at', '>=', Carbon::now()->startOfDay())->orderBy('created_at', 'ASC')->firstOr(function(){
            return \App\Modelo\Tipocambio::latest()->first();
        }); //TODO: tomo el primer tipo de cambio del dia?

        $entries = \App\Modelo\Operacion::where('created_at', '>=', Carbon::now()->startOfDay())
                                        ->where('created_at', '<=', Carbon::now()->endOfDay())
                                        ->where('estado', 2)
                                        ->where('moneda_id', 2) // Ingresan dolares / Compra soles
                                        ->get();

        $outputs = \App\Modelo\Operacion::where('created_at', '>=', Carbon::now()->startOfDay())
                                        ->where('created_at', '<=', Carbon::now()->endOfDay())
                                        ->where('estado', 2)
                                        ->where('moneda_id', 1) // Ingresan soles / Compra dolares
                                        ->get();
        
        $total_entries = $entries->sum('monto') + $initial_box_dol;
        $total_outputs = $outputs->sum('cambio') + $initial_box_dol;
        $total_entries_change = $entries->sum('cambio');
        $total_outputs_change = $outputs->sum('monto') + $initial_box_dol * $exchange_rate->venta;

        $higherCount = count($entries) > count ($outputs) ? count($entries) : count ($outputs);

        $rows = [];

        // FIRST TABLE
        $rows[0][0] 	= "";
        $rows[0][1] 	= 1;
        $rows[0][2] 	= $initial_box_dol;
        $rows[0][3] 	= $exchange_rate->compra;
        $rows[0][4] 	= $initial_box_dol * $exchange_rate->compra;

        // SECOND TABLE
        $rows[0][5] 	= "";
        $rows[0][6] 	= 1;
        $rows[0][7] 	= $initial_box_dol;
        $rows[0][8] 	= $exchange_rate->venta;
        $rows[0][9] 	= $initial_box_dol * $exchange_rate->venta;

        $rows[0][10] 	= "";
        $rows[0][11] 	= "";

        // THIRD TABLE
        if ($rows[0][2] <= $total_outputs) {
            $rows[0][12] = $rows[0][2];
        }
        else {
            $rows[0][12] = $total_outputs;
        }

        if ($rows[0][3] != 0) {
            $rows[0][13] = $rows[0][3];
        }
        else {
            $rows[0][13] = 0;
        }

        $rows[0][14] 	= $rows[0][12] * $rows[0][13];
        $rows[0][15] 	= "";
        $rows[0][16] 	= $rows[0][2] - $rows[0][12];

        if ($rows[0][16] != 0) {
            $rows[0][17] = $rows[0][3];

        }
        else {
            $rows[0][17] = 0;
        }

        $rows[0][18] 	= $rows[0][16] * $rows[0][17];

        for ($i = 1; $i <= $higherCount;$i ++) {
            // FIRST TABLE
            $rows[$i][0] 	= "";
            $rows[$i][1] 	= $i + 1;
            $rows[$i][2] 	= isset($entries[$i - 1]) ? $entries[$i - 1]->monto : 0;
            $rows[$i][3] 	= isset($entries[$i - 1]) ? $entries[$i - 1]->taza : 0;
            $rows[$i][4] 	= isset($entries[$i - 1]) ? $entries[$i - 1]->cambio : 0;

            // SECOND TABLE
            $rows[$i][5] 	= "";
            $rows[$i][6] 	= $i + 1;
            $rows[$i][7] 	= isset($outputs[$i - 1]) ? $outputs[$i - 1]->cambio : 0;
            $rows[$i][8] 	= isset($outputs[$i - 1]) ? $outputs[$i - 1]->taza : 0;
            $rows[$i][9] 	= isset($outputs[$i - 1]) ? $outputs[$i - 1]->monto : 0;

            $rows[$i][10] 	= "";
            $rows[$i][11] 	= "";

            // THIRD TABLE
            $sumAmountEntries = 0;
            for ($j = 0; $j <= $i; $j++) {
                $sumAmountEntries += $rows[$j][2];
            }

            if ($sumAmountEntries <= $total_outputs) {
                $rows[$i][12] = $rows[$i][2];
            }
            else {
                $sumAmountMovements = 0;
                for ($j = 0; $j < $i; $j++) {
                    $sumAmountMovements += $rows[$j][12];
                }
                $rows[$i][12] = $total_outputs - $sumAmountMovements;
            }


            if ($rows[$i][12] != 0) {
                $rows[$i][13] = $rows[$i][3];
            }
            else {
                $rows[$i][13] = 0;
            }

            $rows[$i][14] 	= $rows[$i][12] * $rows[$i][13];
            $rows[$i][15] 	= "";
            $rows[$i][16] 	= $rows[$i][2] - $rows[$i][12];

            if ($rows[$i][16] != 0) {
                $rows[$i][17] = $rows[$i][3];

            }
            else {
                $rows[$i][17] = 0;
            }

            $rows[$i][18] 	= $rows[$i][16] * $rows[$i][17];
        }

        $total_amount_movements = 0;
        $total_amount_movements_change = 0;
        $total_amount_balance_change = 0;
        for ($i = 0; $i < count($rows); $i++) {
            $total_amount_movements += $rows[$i][12];
            $total_amount_movements_change += $rows[$i][14];
            $total_amount_balance_change += $rows[$i][18];
        }

        return view('exports.balance-report', [
            'initial_box_pen' => $initial_box_pen,
            'initial_box_dol' => $initial_box_dol,
            'exchange_rate' => $exchange_rate,
            'total_entries' => $total_entries,
            'total_outputs' => $total_outputs,
            'total_entries_change' => $total_entries_change,
            'total_outputs_change' => $total_outputs_change,
            'total_amount_movements' => $total_amount_movements,
            'total_amount_movements_change' => $total_amount_movements_change,
            'total_amount_balance_change' => $total_amount_balance_change,
            'rows' => $rows,
        ]);
    }
}
