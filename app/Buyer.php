<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends User
{
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
    
}
