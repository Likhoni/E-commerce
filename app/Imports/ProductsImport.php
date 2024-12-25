<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductImage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::create([
            'id'=> $row['id'],
            'product_name'=> $row['name'],
            'group_id'=> $row['group'],
            'category_id'=> $row['catgeory'],
            'brand_id'=> $row['brand'],
            'product_quantity'=> $row['quantity'],
            'product_price'=> $row['price'],
            'discount'=> $row['discount'],
            'discount_price'=> $row['discount_price'],
            'image'=> $row['image'],
            'product_description'=> $row['description'],
        ]);
        if(!empty($row['product_images'])){
            $imageUrls = explode(',', $row['product_images']);
            foreach($imageUrls as $imageUrl)
            {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => trim($imageUrl)
                ]);
            }
        }
        return $product;
    }
}
