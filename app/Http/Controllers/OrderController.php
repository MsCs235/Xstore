<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\Returnorder;
use App\Models\Cart;
use App\Models\Requestt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $item = Order::where('user_id', Auth::user()->id)
            ->whereNot('status' , 'canceled')
            ->orderBy('created_at','DESC')->paginate(5); //using orderBy() function for sorting data by column

        $requests = Requestt::where('user_id' , Auth::user()->id)->get();


        $carts = Cart::all();

            foreach ($carts as $cart) {
                $cart_num = $cart->cart_num;
                $carts_with_same_num = Cart::where('cart_num', $cart_num)->get();
                $all_shipping = true;

                foreach ($carts_with_same_num as $cart_with_same_num) {
                    if ($cart_with_same_num->status != 'delivered') {
                        $all_shipping = false;
                        break;
                    }
                }

                if ($all_shipping) {
                    $order = Order::where('cart_num', $cart->cart_num)->first();
                    if ($order) {
                        $order->status = 'delivered';
                        $order->save();
                    }
                }
            }



        return view('layouts.orders',compact('item' , 'requests'));
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function cancel($order_id)
    {

        $preparing = Order::where('id',$order_id)->first();

        if($preparing->status == 'preparing'){

            Order::where('id', $order_id)
            ->update([
                'status' => 'canceled',
            ]);

        }else{
            return back()->with('error', 'Sorry, Order in shipping prossece');
        }

        return redirect()->back()->with('success','Order Canceled Successfuly');
    }



    public function return(Request $request , $order_id)
    {

        $order = Order::where('id',$order_id)->first();

        if($request->comment == null){
            $request->comment = ' ';
        }

        if($order->status == 'delivered'){

            Order::where('id', $order_id)
            ->update([
                'status' => 'RequestReturn',
            ]);

            $returnOrder = new Returnorder();
            $returnOrder->description = $request->comment;
            $returnOrder->status = 'RequestReturn';
            $returnOrder->order_id = $order_id;
            $returnOrder->save();

        }else{
            return back()->with('error', 'Sorry, this process not work');
        }

        return redirect()->back()->with('success','Your request make Successfuly');
    }


    public function confirm($cart_id)
    {

        $order_carts = Cart::where('id',$cart_id)->get();

        // $carts = Cart::join('products', 'carts.product_id', '=', 'products.id')
        // ->where('carts.id', $cart_id)
        // ->select('carts.*', 'products.*')
        // ->get();

        

        Cart::where('id', $cart_id)
        ->update([
            'status' => 'delivered',
        ]);

        Requestt::where('user_id' , Auth::user()->id)
        ->where('cart_id' , $cart_id)
        ->delete();

        return redirect()->back()->with('success','Order Confirm Successfuly');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->status = 'preparing';
        $order->totalPrice = $request->total_price;
        $order->shippingAddress = Auth::user()->address;
        $order->user_id = Auth::user()->id;
        $order->cart_num = $request->cart_num;

        $order->save();

        Cart::where('cart_num', $request->cart_num)
            ->update([
                'status' => 'Ordered',
                'order_id' => $order->id,
            ]);

        $carts = Cart::where('cart_num', $request->cart_num)->get();

        foreach ($carts as $cart) {
            $new_order_nf = new Requestt();
            $new_order_nf->cart_id = $cart->id;
            $seller_id = $this->getSellerId($cart->product_id);
            $new_order_nf->user_id = $seller_id;
            $new_order_nf->save();
        }

        

        return redirect()->back();
    }

    public function getSellerId($productId)
    {
        $product = Product::find($productId);
        if ($product && $product->User) {
            return $product->User->id;
        }
        return null; // or throw an exception if no seller is found
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
