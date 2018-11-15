<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;

class Product extends Model
{
    use SoftDeletes;

    public $transformer = ProductTransformer::class;
    protected $dates = ['deleted_at'];

    const AVALIABLE_PRODUCT = 'avaliable';
    const UNAVALIABLE_PRODUCT = 'unavaliable';

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id'
];

protected $hidden = [
    'pivot'
];

    public function isAvaliable(){
        return $this->status == Product::AVALIABLE_PRODUCT;
    }
    
   public function seller() {
        return $this->belongsTo(Seller::class);
   }

   public function categories(){
       return $this->belongsToMany(Category::class);
   }

   public function transactions(){
       return $this->hasMany(Transaction::class);
   }

}