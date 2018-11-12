<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\SellerScope;

class Seller extends User
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
   
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SellerScope());
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
