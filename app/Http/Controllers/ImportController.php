<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessaExcel;
use Illuminate\Http\Request;
use App\Job;


class ImportController extends Controller
{
    public function importar(Request $req)
    {
        try{
            $identifier_file = date("U");
            $fileName = '_' . $identifier_file . 'planilha.xlsx';
            $path = $req->file('file')->move(resource_path('spreadsheets'), $fileName);

            ProcessaExcel::dispatch($path->getPathname())->delay(now()->addSeconds('20'));

            $returned = array('tracking_code' => $identifier_file,
                'msg'           => 'O arquivo foi importado com sucesso!'
            );
            return response()->json(['data' => $returned], 200);

        } catch (\Exception $e){
            return response()->json(['data' => ['msg' => 'Erro interno']], 500);
        }

    }
}
