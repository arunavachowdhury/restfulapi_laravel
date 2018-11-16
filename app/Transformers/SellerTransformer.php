<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Seller;

class SellerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Seller $seller)
    {
        return [
            'identifier' => (int)$seller->id,
            'userName' => (string)$seller->name,
            'userEmail' => (string)$seller->email,
            'isVerified' => (int)$seller->varified,
            'createdDate' => (string)$seller->created_at,
            'lastChange' => (string)$seller->updated_at,
            'deletedDate' => isset($seller->deleted_at) ? (string)$seller->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'userName' => 'name',
            'userEmail' => 'email',
            'isVerified' => 'varified',
            'createdDate' => 'created_at',
            'lastChange' => 'updated_at',
            'deletedDate' => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformAttribute($index)
    {
        $attributes = [
            'id' => 'identifier',
            'name' => 'userName',
            'email' => 'userEmail',
            'varified' => 'isVerified',
            'created_at' => 'createdDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    } 
}
