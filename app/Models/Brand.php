<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function parentBrand(){
        return $this->hasOne(Brand::class,'id','parent_id');
    }

    public function product(){
        return $this->belongsToMany(Product::class,); 
    }
}
