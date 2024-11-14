<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'price',
        'qty',
    ];

    protected $table = "carts";
    protected $primaryKey = "id";

    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function Product(){
        return $this->belongsTo(Product::class,'product_id', 'id');
    }

    public function Order(){
        return $this->belongsTo(Order::class,'order_id', 'id');
    }

    public function Requestt(){
        return $this->hasMany(Requestt::class,'cart_id', 'id'); //fk , pk
    }

}
