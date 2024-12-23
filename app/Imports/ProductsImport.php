<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'id'=> $row['id'],
            'product_name'=> $row['product_name'],
            'product_price'=> $row['product_price'],
        ]);
    }

    public function rules():array
    {
        return
        [
           'product_name'  => 'required', 
           'product_price'  => 'required', 
        ];
    }
}
