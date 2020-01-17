<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
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
    public function transform(Transaction $transaction)
    {
        return [
            'identifier'    =>  (int) $transaction->id,
            'quantity'      =>  (int) $transaction->quantity,
            'buyer'         =>  (int) $transaction->buyer_id,
            'product'       =>  (int) $transaction->product_id,
            'create_date'   => (string) $transaction->created_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identifier'    =>  'id',
            'quantity'      =>  'quantity',
            'email'         =>  'email',
            'buyer'         =>  'buyer_id',
            'product'       =>  'product_id',
            'create_date'   =>  'created_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}