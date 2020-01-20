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
            'links' =>[
                [
                    'rel'       =>  'self',
                    'href'      =>  route('sellers.show', $seller->id)
                ],
                [
                    'rel'       =>  'seller.buyers',
                    'href'      =>  route('sellers.buyers.index', $seller->id)
                ],
                [
                    'rel'       =>  'seller.categories',
                    'href'      =>  route('sellers.categories.index', $seller->id)
                ],
                [
                    'rel'       =>  'seller.transactions',
                    'href'      =>  route('sellers.transactions.index', $seller->id)
                ],
                [
                    'rel'       =>  'seller.products',
                    'href'      =>  route('sellers.products.index', $seller->id)
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
            'id'    =>  'identifier' ,
            'name'  =>  'name'       ,
            'email' =>  'email'      ,
            'verified'  =>  'is_verified',
            'created_at'    =>  'create_date',
            'updated_at'    =>  'last_change',
            'deleted_at' =>  'delete_date',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}