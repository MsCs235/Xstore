<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'password',
        'rule',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function Product(){
        return $this->hasMany(Product::class,'user_id', 'id');
    }

    public function Cart(){
        return $this->hasMany(Cart::class,'user_id', 'id');
    }

    public function requestt(){
        return $this->hasMany(Requestt::class,'user_id', 'id'); //fk , pk
    }
    public function Review(){
        return $this->hasMany(Review::class,'user_id', 'id'); //fk , pk
    }

    public function Auction(){
        return $this->hasMany(Auction::class,'user_id', 'id');
    }

    public function Bid(){
        return $this->hasMany(Bid::class,'user_id', 'id');
    }
}
