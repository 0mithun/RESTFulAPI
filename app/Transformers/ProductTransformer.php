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
            'seller_id'     =>  (int) $product->seller_id,
            'create_date'   =>  (string)$product->created_at,
            'last_change'   =>  (string)$product->updated_at,
            'delete_date'   =>  isset($product->deleted_at) ? (string) $product->deleted_at: NULL,
        ];
    }
}
