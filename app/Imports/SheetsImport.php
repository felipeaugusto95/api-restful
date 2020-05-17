<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SheetsImport implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            new ProdutosImport()
        ];
    }
}
