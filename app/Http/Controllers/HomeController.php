<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Auction;
use App\Models\Returnorder;
use App\Models\Cart;
use App\Models\Requestt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $subquery = DB::table('product_imgs')
            ->select('product_id', DB::raw('MIN(id) as min_id'))
            ->groupBy('product_id');

        $products = DB::table('products')
            ->joinSub($subquery, 'product_imgs', function ($join) {
                $join->on('products.id', '=', 'product_imgs.product_id');
            })
            ->join('product_imgs', 'product_imgs.id', '=', 'product_imgs.min_id')
            ->select('products.*', 'product_imgs.*')
            ->where('offer' , null)
            ->inRandomOrder()
            ->take(15)
            ->get();


        $offers = DB::table('products')
            ->joinSub($subquery, 'product_imgs', function ($join) {
                $join->on('products.id', '=', 'product_imgs.product_id');
            })
            ->join('product_imgs', 'product_imgs.id', '=', 'product_imgs.min_id')
            ->select('products.*', 'product_imgs.*')
            ->whereNot('offer' , null)
            ->inRandomOrder()
            ->take(15)
            ->get();



        $sub = DB::table('auction_imgs')
            ->select('auction_id', DB::raw('MIN(id) as min_id'))
            ->groupBy('auction_id');

        $auctions = DB::table('auctions')
            ->joinSub($sub, 'auction_imgs', function ($join) {
                $join->on('auctions.id', '=', 'auction_imgs.auction_id');
            })
            ->join('auction_imgs', 'auction_imgs.id', '=', 'auction_imgs.min_id')
            ->select('auctions.*', 'auction_imgs.*')
            ->where('auctions.status' , 'Open')
            ->inRandomOrder()
            ->take(15)
            ->get();


        

        return view('home', compact('products' , 'offers' , 'auctions'));

    }


    public function overview(){
        // overview
        $received = Order::where('user_id', Auth::user()->id)
            ->where('status' , 'delivered')
            ->orWhere('status' , 'RequestReturn')
            ->orderBy('created_at','DESC')->get();

        

        return view('layouts.overview',compact('received'));
    }

}
