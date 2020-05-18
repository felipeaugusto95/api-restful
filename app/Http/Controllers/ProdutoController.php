<?php

namespace App\Http\Controllers;

use App\Produto;
use http\Env\Response;

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

    public function index()
    {
        try{
            $data = ['data' => $this->produto->all()];
            return response()->json($data, 200);
        } catch (\Exception $e){
            return response()->json(['msg' => 'Erro interno.'], 500);
        }
    }

    public function mostrar($id)
    {
        try{
            $prod = $this->produto->find($id);

            if(!$prod)
                return response()->json(['data' => ['msg' => 'Produto não encontrado!']], 404);

            $data = ['data' => $prod];
            return response()->json($data, 200);
        } catch (\Exception $e){
            return response()->json(['msg' => 'Erro interno.'], 500);
        }
    }

    public function deletar(Produto $id)
    {
        try{
            $id->delete();
            return response()->json(['data' =>['msg' => 'Produto deletado com sucesso!']], 200);
        } catch (\Exception $e){
            return response()->json(['msg' => 'Erro interno.'], 500);
        }
    }
}
