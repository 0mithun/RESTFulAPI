<?php

namespace App\Http\Controllers\Product;

use DB;
use App\User;
use App\Buyer;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Transaction;

class ProductBuyerTransactionController extends ApiController
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, User $buyer)
    {
        $rules = [
            'quantity'      =>  'required|integer|min:1'
        ];  

        $this->validate($request, $rules);


        if($buyer->id == $product->seller_id){
            return $this->errorResponse('The buyer must be different from the seller', 409);
        }

        if(!$buyer->isVerified()){
            return $this->errorResponse('The buyer must be a verify user', 409);
        }
        if(!$product->seller->isVerified()){
            return $this->errorResponse('The seller must be a verify user', 409);
        }


        if(!$product->isAvailable()){
            return $this->errorResponse('The product is not available', 409);
        }

        if($product->quantity < $request->quantity){
            return $this->errorResponse('The product does not have enough units for this transactions', 409);
        }

        
        return DB::transaction(function () use($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity'      =>  $request->quantity,
                'buyer_id'      =>  $buyer->id,
                'product_id'    =>  $product->id
            ]);

            return $this->showOne($transaction, 201);
        });
    }

}
