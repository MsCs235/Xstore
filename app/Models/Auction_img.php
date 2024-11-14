<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction_img extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_url',
        'auction_id',
    ];

    protected $table = "auction_imgs";
    protected $primaryKey = "id";

    public function Auction(){
        return $this->belongsTo(Auction::class,'auction_id', 'id');
    }
}
