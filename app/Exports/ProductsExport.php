<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select("id","product_name", "product_price")->get();
    }

    public function headings():array
    {
        return ["ID", "Name", "Price"];
    }
}
