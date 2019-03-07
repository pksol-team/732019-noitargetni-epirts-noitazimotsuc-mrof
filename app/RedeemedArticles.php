<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedeemedArticles extends Model
{
    //
    protected $fillable = ['articles_count','amount'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
