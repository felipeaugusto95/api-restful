<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class ProcessamentoController extends Controller
{
    private $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

    public function verifica($id){

        $job = $this->job->find($id);

        if(!$job)
            return response()->json(['data' => ['msg' => 'Planilha já foi processada!']], 200);

        $data = ['data' => ['msg' => 'Planilha na fila para processamento']];
        return response()->json($data, 200);
    }
}
