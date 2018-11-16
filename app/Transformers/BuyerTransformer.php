<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Buyer;

class BuyerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Buyer $buyer)
    {
        return [
            'identifier' => (int)$buyer->id,
            'userName' => (string)$buyer->name,
            'userEmail' => (string)$buyer->email,
            'isVerified' => (int)$buyer->varified,
            'createdDate' => (string)$buyer->created_at,
            'lastChange' => (string)$buyer->updated_at,
            'deletedDate' => isset($buyer->deleted_at) ? (string)$buyer->deleted_at : null,
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
