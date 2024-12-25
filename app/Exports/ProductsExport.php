<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::with('images')->get()->map(function ($product) {
            return [
                'id'                 => $product->id,
                'product_name'       => $product->product_name,
                'group_id'           => $product->group_id,
                'category_id'        => $product->category_id,
                'brand_id'           => $product->brand_id,
                'product_quantity'   => $product->product_quantity,
                'product_price'      => $product->product_price,
                'discount'           => $product->discount,
                'discount_price'     => $product->discount_price,
                'image'              => $product->image,
                'product_images'     => $product->images->pluck('image_url')->implode(', '), // Combine image paths
                'product_description' => $product->product_description,
            ];
        });
    }

    public function headings(): array
    {
        return ["ID", "Name", "Group", "Catgeory", "Brand", "Quantity", "Price", "Discount", "Discount Price", "Image", "Product Images", "Description"];
    }
}
