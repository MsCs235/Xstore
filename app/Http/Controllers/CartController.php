<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Cart::where('user_id', Auth::user()->id)
        ->where('status' , 'unOrdered')
        ->get();


        return view('layouts.shopingcart',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($productId, Request $request)
    {
        $items = Cart::where('user_id', Auth::user()->id)
            ->where('status', 'unOrdered')
            ->select('cart_num')
            ->get();

        $item = new Cart();
        $item->status = 'unOrdered';
        $item->qty = $request->qty ?? 1;
        $item->price = $request->price;
        $item->product_id = $productId;
        $item->user_id = Auth::user()->id;

        if ($items->isNotEmpty()) {
            $item->cart_num = $items->first()->cart_num;
        } else {
            $item->cart_num = time(). Auth::user()->id;
        }

        $item->save();
        return redirect(route('view.cart'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cart_id)
    {
        Cart::where('id', $cart_id)->delete();
        return redirect()->back();
    }
}
