<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Auction_img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    public function index()
    {
        $item = Auction::where('user_id', Auth::user()->id)
            ->orderBy('created_at','DESC')->paginate(5); //using orderBy() function for sorting data by column


        $now = now()->addHours(3)->format('Y-m-d H:i:s');

        $auction_close = Auction::all();

        foreach ($auction_close as $auction) {
            if ($auction->EndTime <= $now) {
                $auction->status = 'Close';
                $auction->save();
            }
        }


        return view('layouts.auction',compact('item'));
    }

    public function closeAuctionView($auction_id){
        // dd($auction_id);


        $item = DB::table('auctions')
        ->join('bids', 'auctions.id', '=', 'bids.auction_id')
        ->join('users', 'bids.user_id', '=', 'users.id')
        ->latest('bids.created_at')
        ->where('auctions.id' , $auction_id) 
        ->first();

        // dd($item);

        return view('layouts.auctionwinner',compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $auction_id)
    {
        // dd($auction_id, $request->all());

        if($request->lastbid == 0){
            $new_bid = $request->initialbid + $request->startPrice;
        }else{
            $new_bid = $request->initialbid + $request->lastbid;
        }

        

        $bid = new Bid();
        $bid->bid = $new_bid;
        $bid->user_id = Auth::user()->id ;
        $bid->auction_id = $auction_id;
        $bid->save();

        Auction::where('id', $auction_id)
            ->update([
                'Bid' => $bid->bid,
            ]);

        return redirect()->back();
    }


    public function view($auction_img)
    {
        $productImg = Auction_img::where('img_url', $auction_img)->first();

        if (!$productImg) {
            // Handle the case where the product image is not found
            abort(404);
        }
        $item = $productImg->Auction; // Assuming the relationship is defined as "auction" in the ProductImg model


        return view('layouts.auctionpage',compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // using request method to get data from view 
        $item = new Auction();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->startPrice = $request->startprice;
        $item->category = $request->category ;
        $item->EndTime = $request->EndTime;
        $item->initialBid = $request->initialBid;
        $item->Bid = 0 ;
        $item->status = 'Open' ;
        $item->user_id = Auth::user()->id ;

        $item->save();


        // handel images
        if ($request->hasFile('photos')) {
            $images = $request->file('photos');
            $path = 'imgs/auctions';

            // $images is now an array of UploadedFile objects
            $i = 0 ;
            foreach ($images as $image) {
                // Do something with each image, e.g., store it in a database or upload to a cloud storage
                $p_ext = $image->getClientOriginalExtension();
                $photo_name = time() . $i . $item->title . '.' . $p_ext;
                $image->move($path,$photo_name); 

                $photo = new Auction_img();
                $photo->img_url = $photo_name ;
                $photo->auction_id = $item->id ;
                $photo->save();
                $i = $i + 1 ;
            }
        } else {
            // Handle the case where the input is not a valid file upload
            return back()->with('error', 'Invalid file upload');
        }

        return redirect(route('userauctions'))->with('success','Product Created Successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show( $auction_id)
    {
        $item = Auction::where('id',$auction_id)->first();

        return view('layouts.editeauction',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $auction_id)
    {

        Auction::where('id', $auction_id)
            ->update([
                'title' => $request->title,
                'startPrice' => $request->startprice,
                'description' => $request->description,
                'EndTime' => $request->EndTime,
                'category' => $request->category,
                'initialBid' => $request->initialBid,
                'status' => $request->status,
            ]);


            $product_img_name = Auction_img::where('auction_id',$auction_id)->first();


            // handel new images
            if ($request->hasFile('photos')) {
                $images = $request->file('photos');
                $path = 'imgs/auctions';

                // $images is now an array of UploadedFile objects
                $i = 0 ;
                foreach ($images as $image) {
                    // Do something with each image, e.g., store it in a database or upload to a cloud storage
                    $p_ext = $image->getClientOriginalExtension();
                    $photo_name = 'new' . $i . $product_img_name->img_url;
                    $image->move($path,$photo_name); 

                    $photo = new Auction_img();
                    $photo->img_url = $photo_name ;
                    $photo->auction_id = $auction_id;
                    $photo->save();
                    $i = $i + 1 ;
                }
            } else {
                // Handle the case where the input is not a valid file upload
                return back()->with('error', 'Invalid file upload');
            }

        return redirect(route('userauctions'))->with('success','Product Updated Successfuly'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($auction_id)
    {
        $product = Auction::where('id', $auction_id)->first();
        if ($product) {
            $image_path = public_path('imgs/auctions/');
            $files_to_delete = Auction_img::where('auction_id', $auction_id)
                ->pluck('img_url')
                ->all();

            foreach ($files_to_delete as $file) {
                $file_path = $image_path . $file;
                if (File::exists($file_path)) {
                    unlink($file_path);
                }
            }
        }
        
        Auction_img::where('auction_id', $auction_id)->delete();
        Auction::where('id', $auction_id)->delete();

        return redirect()->back();
    }
}
