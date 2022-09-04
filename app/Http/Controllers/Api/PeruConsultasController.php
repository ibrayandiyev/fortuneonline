<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Peru\Jne\DniFactory;
use Peru\Sunat\RucFactory;

class PeruConsultasController extends Controller
{
    public function queryByDNI(Request $request, $document_number)
    {
        $factory = new DniFactory();
        $cs = $factory->create();

        $personData = $cs->get($document_number);
        if (!$personData) {
            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $personData
        ]);
    }

    public function queryByRUC(Request $request, $ruc)
    {
        $factory = new RucFactory();
        $cs = $factory->create();

        $companyData = $cs->get($ruc);
        if (!$companyData) {
            return response()->json([
                'success' => false
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $companyData
        ]);
    }
}
