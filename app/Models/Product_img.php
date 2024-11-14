<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_img extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_url',
        'product_id',
    ];

    protected $table = "product_imgs";
    protected $primaryKey = "id";


    public function Product(){
        return $this->belongsTo(Product::class,'product_id', 'id');
    }
}
