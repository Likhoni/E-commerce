<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_permission extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function role()
    {
        return $this->belongsToMany(Role::class,'role_id'); 
    }

    public function permission()
    {
        return $this->belongsToMany(Permission::class,'permission_id'); 
    }
}
