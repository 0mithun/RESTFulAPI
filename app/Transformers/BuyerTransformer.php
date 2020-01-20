<?php

namespace App\Transformers;

use App\Buyer;
use League\Fractal\TransformerAbstract;

class BuyerTransformer extends TransformerAbstract
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
    public function transform(Buyer $buyer)
    {
        return [
            'identifier'    =>  (int) $buyer->id,
            'name'          =>  (string) $buyer->name,
            'email'         =>  (string) $buyer->email,
            'is_verified'   =>  (bool) $buyer->verified,
            'create_date'   =>  (string)$buyer->created_at,
            'last_change'   =>  (string)$buyer->updated_at,
            'delete_date'   =>  isset($buyer->deleted_at) ? (string) $buyer->deleted_at: NULL,
            'links' =>[
                [
                    'rel'       =>  'self',
                    'href'      =>  route('buyers.show', $buyer->id)
                ],
                [
                    'rel'       =>  'buyer.buyers',
                    'href'      =>  route('buyers.sellers.index', $buyer->id)
                ],
                [
                    'rel'       =>  'buyer.categories',
                    'href'      =>  route('buyers.categories.index', $buyer->id)
                ],
                [
                    'rel'       =>  'buyer.transactions',
                    'href'      =>  route('buyers.transactions.index', $buyer->id)
                ],
                [
                    'rel'       =>  'buyer.products',
                    'href'      =>  route('buyers.products.index', $buyer->id)
                ],
            ]
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

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id'            =>  'identifier' ,
            'name'          =>  'name'       ,
            'email'         =>  'email'      ,
            'verified'      =>  'is_verified',
            'created_at'    =>  'create_date',
            'updated_at'    =>  'last_change',
            'deleted_at'    =>  'delete_date',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}