<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'brand',
        'description',
        'price',
        'category',
        'stock',
        'offer',
    ];

    protected $table = "products";
    protected $primaryKey = "id";

    public function Product_imgs(){
        return $this->hasMany(Product_img::class,'product_id', 'id');
    }


    public function User(){
        return $this->belongsTo(User::class,'user_id', 'id'); //fk , pk
    }

    public function Cart(){
        return $this->hasMany(Cart::class,'product_id', 'id'); //fk , pk
    }
    public function Review(){
        return $this->hasMany(Review::class,'product_id', 'id'); //fk , pk
    }
}
