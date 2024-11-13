<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\District;
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

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }
    
}
