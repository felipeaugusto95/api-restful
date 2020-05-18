<?php

namespace App\Imports;

use App\Produto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdutosImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(($row['nome'] && $row['quantidade']) && is_numeric($row['quantidade'])) {
            if (isset($row['id'])) {
                if ($prod = Produto::find($row['id'])) {
                    $prod->nome = $row['nome'];
                    $prod->quantidade = $row['quantidade'];
                    $prod->save();

                    return $prod;
                }
            }

            return new Produto([
                'nome' => $row['nome'],
                'quantidade' => $row['quantidade']
            ]);
        }
        return null;
    }

}
