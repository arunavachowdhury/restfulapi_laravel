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
}
