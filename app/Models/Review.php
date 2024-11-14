<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'rating',
    ];

    protected $table = "reviews";
    protected $primaryKey = "id";

    public function Product(){
        return $this->belongsTo(Product::class,'product_id', 'id'); //fk , pk
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id'); //fk , pk
    }
}
