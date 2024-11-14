<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'startPrice',
        'EndTime',
        'initialBid',
        'Bid',
        'status',
    ];

    protected $table = "auctions";
    protected $primaryKey = "id";

    public function Auction_imgs(){
        return $this->hasMany(Auction_img::class,'auction_id', 'id');
    }


    public function User(){
        return $this->belongsTo(User::class,'user_id', 'id'); //fk , pk
    }

    public function Bid(){
        return $this->hasMany(Bid::class,'auction_id', 'id');
    }
}
