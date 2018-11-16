<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Illuminate\Foundation\Auth\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier' => (int)$user->id,
            'userName' => (string)$user->name,
            'userEmail' => (string)$user->email,
            'isVerified' => (int)$user->varified,
            'isAdmin' => ($user->admin === 'true'),
            'createdDate' => (string)$user->created_at,
            'lastChange' => (string)$user->updated_at,
            'deletedDate' => isset($user->deleted_at) ? (string)$user->deleted_at : null,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier' => 'id',
            'userName' => 'name',
            'userEmail' => 'email',
            'isVerified' => 'varified',
            'isAdmin' => 'admin',
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
            'admin' => 'isAdmin',
            'created_at' => 'createdDate',
            'updated_at' => 'lastChange',
            'deleted_at' => 'deletedDate',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    } 
        
    
}
