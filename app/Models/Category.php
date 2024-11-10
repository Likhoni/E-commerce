<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function parentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    
    public function product()
    {
        return $this->hasMany(Product::class,);
    }

    public function brand()
    {
        return $this->hasMany(Brand::class, 'brand_id');
    }
}
