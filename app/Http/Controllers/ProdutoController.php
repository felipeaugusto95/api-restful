<?php

namespace App\Http\Controllers;

use App\Produto;
use http\Env\Response;
use Illuminate\Http\Request;
use function Psy\debug;

class ProdutoController extends Controller
{
    /**
     * @var Produto
     */
    private $produto;

    public function __construct(Produto $produto)
    {
        $this->produto = $produto;
    }

    public function index(){
        $data = ['data' => $this->produto->all()];
        return response()->json($data);
    }

    public function mostrar($id){

        $prod = $this->produto->find($id);

        if(!$prod)
            return response()->json(['data' => ['msg' => 'Produto não encontrado!']], 204);

        $data = ['data' => $prod];
        return response()->json($data, 200);
    }

    public function deletar(Produto $id){
        try{
            $id->delete();
            return response()->json(['msg' => 'Produto deletado com sucesso!'], 201);
        } catch (\Exception $e){
            return response()->json(['msg' => 'Houve um erro ao realizar a operação.'.$e->getMessage()], 500);
        }
    }
}
