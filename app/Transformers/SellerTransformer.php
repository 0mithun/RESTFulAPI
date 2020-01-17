<?php

namespace App\Transformers;

use App\Seller;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
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
    public function transform(Seller $seller)
    {
        return [
            'identifier'    =>  (int) $seller->id,
            'name'          =>  (string) $seller->name,
            'email'         =>  (string) $seller->email,
            'is_verified'   =>  (bool) $seller->verified,
            'create_date'   =>  (string)$seller->created_at,
            'last_change'   =>  (string)$seller->updated_at,
            'delete_date'   =>  isset($seller->deleted_at) ? (string) $seller->deleted_at: NULL,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier'    =>  'id',
            'name'          =>  'name',
            'email'         =>  'email',
            'is_verified'   =>  'verified',
            'create_date'   =>  'created_at',
            'last_change'   =>  'updated_at',
            'delete_date'   =>  'deleted_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
