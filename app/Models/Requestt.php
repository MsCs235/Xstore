<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestt extends Model
{
    use HasFactory;

    protected $table = 'requestts';

    public function Cart(){
        return $this->belongsTo(Cart::class,'cart_id', 'id'); //fk , pk
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id'); //fk , pk
    }
}
