<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
