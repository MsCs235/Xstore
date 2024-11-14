<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'bid',
        'auction_id',
        'user_id',
    ];

    protected $table = "bids";
    protected $primaryKey = "id";

    public function User(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function Auction(){
        return $this->belongsTo(Auction::class,'auction_id', 'id');
    }
}
