<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidMessage extends Model
{
    //
    protected $fillable = ['message','bid_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bid(){
        return $this->belongsTo(Bid::class);
    }

    public function isRead(){
        return $this->seen == 1;
    }

    public function markRead(){
        $this->seen = 1;
        $this->update();
    }
}
