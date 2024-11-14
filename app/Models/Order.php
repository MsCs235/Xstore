<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'totalPrice',
        'shippingAddress',
    ];

    protected $table = "orders";
    protected $primaryKey = "id";

    public function Cart(){
        return $this->hasMany(Cart::class,'order_id', 'id');
    }

    public function Returnorder(){
        return $this->belongsTo(Returnorder::class,'order_id', 'id');
    }
}
