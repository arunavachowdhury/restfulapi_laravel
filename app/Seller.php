<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seller extends User
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    public function product(){
        return $this->hasMany(Product::class);
    }
}
