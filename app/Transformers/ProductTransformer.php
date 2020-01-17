<?php

namespace App\Transformers;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
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
    public function transform(Product $product)
    {
        return [
            'identifier'    =>  (int) $product->id,
            'title'         =>  (int) $product->title,
            'detail'        =>  (string) $product->description,
            'stock'         =>  (int) $product->quantity,
            'situation'     =>  (int) $product->status,
            'picture'       =>  url('img/'.$product->image),
            'seller'        =>  (int) $product->seller_id,
            'create_date'   =>  (string)$product->created_at,
            'last_change'   =>  (string)$product->updated_at,
            'delete_date'   =>  isset($product->deleted_at) ? (string) $product->deleted_at: NULL,
            'links' =>[
                [
                    'rel'       =>  'self',
                    'href'      =>  route('products.show', $product->id)
                ],
                [
                    'rel'       =>  'products.buyers',
                    'href'      =>  route('products.buyers.index', $product->id)
                ],
                [
                    'rel'       =>  'products.categories',
                    'href'      =>  route('products.categories.index', $product->id)
                ],
                [
                    'rel'       =>  'products.transactions',
                    'href'      =>  route('products.transactions.index', $product->id)
                ],
                [
                    'rel'       =>  'sellers',
                    'href'      =>  route('sellers.show', $product->seller_id)
                ],
            ]
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier'     =>  'id',
            'title'          =>  'name',
            'detail'         =>  'description',
            'stock'          =>  'quantity',
            'situation'      =>  'status',
            'seller'         =>  'seller_id',
            'create_date'    =>  'created_at',
            'last_change'    =>  'updated_at',
            'delete_date'    =>  'deleted_at'
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
