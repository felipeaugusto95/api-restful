<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Support\Facades\DB;

class ProcessamentoController extends Controller
{
    public function verifica($id)
    {
        try{
            $failed = DB::table('failed_jobs')
                    ->where('payload', 'like', "%$id%")
                    ->get();

            if($failed->all())
                return response()->json(['data' => ['msg' => 'Houve um erro ao processsar a planilha!']], 200);

            $job = DB::table('jobs')
                ->where('payload', 'like', "%$id%")
                ->get();

            $data = ($job->all()) ? ['data' => ['msg' => 'Planilha na fila para processamento!']] : ['data' => ['msg' => 'A planilha foi processada com sucesso!']];

            return response()->json($data, 200);

        } catch (\Exception $e){
            return response()->json(['data' => ['msg' => 'Erro interno']], 500);
        }
    }
}
