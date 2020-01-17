<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'identifier'    =>  (int) $user->id,
            'name'          =>  (string) $user->name,
            'email'         =>  (string) $user->email,
            'is_verified'   =>  (bool) $user->verified,
            'is_admin'      =>  ($user->admin === 'true'),
            'create_date'   =>  (string) $user->created_at,
            'last_change'   =>  (string) $user->updated_at,
            'delete_date'   =>  isset($user->deleted_at) ? (string) $user->deleted_at: NULL,
        ];
    }
}
