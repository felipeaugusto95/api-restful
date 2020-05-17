<?php

namespace App\Http\Controllers;

use App\Imports\ProdutosImport;
use App\Imports\SheetsImport;
use App\Jobs\ProcessaExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use App\Produto;
use App\Job;


class ImportController extends Controller
{
    public function importar(Request $req)
    {
        $fileName = '_' . date("YmdHmsu") . 'planilha.xlsx';
        $path = $req->file('file')->move(public_path("/"), $fileName);

        ProcessaExcel::dispatch($path->getPathname())->delay(now()->addSeconds('5'));

        $id = Job::select('id')->orderBy('created_at', 'desc')->limit(1)->get();
        $returned = array('tracking_code' => $id,
                          'msg'           => 'O arquivo foi importado com sucesso!'
        );
        return response()->json(['data' => $returned], 200);
    }
}
