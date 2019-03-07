<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
    protected $fillable = ['user_id','amount','message'];

    /**
     * Belongs to an order
     */

    public function order(){
        return $this->belongsTo(Order::class);
    }

    /**
     * Belongs to a writer
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getClientAmount(){
        $client_website = $this->order->user->website;
        $amount = $this->amount;
        $commission = $client_website->commission/100;
        $commission+=1;
        $amount = $amount*$commission;
        return $amount;
    }

    public function messages(){
        return $this->hasMany(BidMessage::class);
    }
}
