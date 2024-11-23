<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Devfaysal\BangladeshGeocode\Models\Union;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class,'division_id');
    }
    
    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    
    public function upazila()
    {
        return $this->belongsTo(Upazila::class,'upazila_id');
    }
    
    public function union()
    {
        return $this->belongsTo(Union::class,'union_id');
    }
    
}
