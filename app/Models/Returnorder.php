<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returnorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'order_id',
    ];

    protected $table = "returnorders";
    protected $primaryKey = "id";

    public function Order(){
        return $this->belongsTo(Order::class,'order_id', 'id');
    }
}
