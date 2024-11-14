<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\Product_img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Auction;
use App\Models\Auction_img;
class ProductController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Product::where('user_id', Auth::user()->id)
            ->orderBy('created_at','DESC')->paginate(5); //using orderBy() function for sorting data by column

        // $item = DB::table('Products')
        // ->join('Product_imgs', 'Products.id', '=', 'Product_imgs.product_id')
        // ->get();

        return view('layouts.products',compact('item'));
    }


    // search view data
    public function search(Request $request){

        // $search = Product::where('title' , $request->search)

        $searchValue = strtolower($request->search); // Convert search value to lowercase

        $products = Product::where(function ($query) use ($searchValue) {
            $query->whereRaw("LOWER(title) LIKE CONCAT('%', ?, '%')", [$searchValue])
                ->orWhereRaw("LOWER(description) LIKE CONCAT('%', ?, '%')", [$searchValue]);
        })->get();

        $auctions = Auction::where(function ($query) use ($searchValue) {
            $query->whereRaw("LOWER(title) LIKE CONCAT('%', ?, '%')", [$searchValue])
                ->orWhereRaw("LOWER(description) LIKE CONCAT('%', ?, '%')", [$searchValue]);
        })->get();

        // dd($products);

        return view('layouts.searchresult' , compact('products', 'auctions' , 'searchValue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function view($product_img)
    {
        $productImg = Product_img::where('img_url', $product_img)->first();

        if (!$productImg) {
            // Handle the case where the product image is not found
            abort(404);
        }
        $item = $productImg->product; // Assuming the relationship is defined as "product" in the ProductImg model

        $review = Review::where('product_id' , $item->id)->get();

        return view('layouts.productpage',compact('item' , 'review'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // using request method to get data from view 
        $item = new Product();
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->offer = $request->offer;
        $item->category = $request->category ;
        $item->brand = $request->brand;
        $item->stock = $request->stock ;
        $item->user_id = Auth::user()->id ;

        $item->save();


        // handel images
        if ($request->hasFile('photos')) {
            $images = $request->file('photos');
            $path = 'imgs/products';

            // $images is now an array of UploadedFile objects
            $i = 0 ;
            foreach ($images as $image) {
                // Do something with each image, e.g., store it in a database or upload to a cloud storage
                $p_ext = $image->getClientOriginalExtension();
                $photo_name = time() . $i . $item->title . '.' . $p_ext;
                $image->move($path,$photo_name); 

                $photo = new Product_img();
                $photo->img_url = $photo_name ;
                $photo->product_id = $item->id ;
                $photo->save();
                $i = $i + 1 ;
            }
        } else {
            // Handle the case where the input is not a valid file upload
            return back()->with('error', 'Invalid file upload');
        }

        return redirect(route('userproducts'))->with('success','Product Created Successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show($product_id)
    {
        $item = Product::where('id',$product_id)->first();

        return view('layouts.editeproduct',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function filter($value )
    {
        
        $searchValue = strtolower($value); // Convert search value to lowercase

        

        $products = Product::where(function ($query) use ($searchValue) {
            $query->whereRaw("LOWER(title) LIKE CONCAT('%', ?, '%')", [$searchValue])
                ->orWhereRaw("LOWER(description) LIKE CONCAT('%', ?, '%')", [$searchValue])
                ->orWhereRaw("LOWER(category) LIKE CONCAT('%', ?, '%')", [$searchValue]);
        })->get();

        $auctions = Auction::where(function ($query) use ($searchValue) {
            $query->whereRaw("LOWER(title) LIKE CONCAT('%', ?, '%')", [$searchValue])
                ->orWhereRaw("LOWER(description) LIKE CONCAT('%', ?, '%')", [$searchValue])
                ->orWhereRaw("LOWER(category) LIKE CONCAT('%', ?, '%')", [$searchValue]);
        })->get();

        

        return view('layouts.searchresult' , compact('products', 'auctions' , 'searchValue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product_id)
    {

        Product::where('id', $product_id)
            ->update([
                'title' => $request->title,
                'brand' => $request->brand,
                'description' => $request->description,
                'price' => $request->price,
                'offer' => $request->offer,
                'category' => $request->category,
                'stock' => $request->stock,
            ]);


            $product_img_name = Product_img::where('product_id',$product_id)->first();


            // handel new images
            if ($request->hasFile('photos')) {
                $images = $request->file('photos');
                $path = 'imgs/products';

                // $images is now an array of UploadedFile objects
                $i = 0 ;
                foreach ($images as $image) {
                    // Do something with each image, e.g., store it in a database or upload to a cloud storage
                    $p_ext = $image->getClientOriginalExtension();
                    $photo_name = 'new' . $i . $product_img_name->img_url;
                    $image->move($path,$photo_name); 

                    $photo = new Product_img();
                    $photo->img_url = $photo_name ;
                    $photo->product_id = $product_id;
                    $photo->save();
                    $i = $i + 1 ;
                }
            } else {
                // Handle the case where the input is not a valid file upload
                return back()->with('error', 'Invalid file upload');
            }

            return redirect(route('userproducts'))->with('success','Product Updated Successfuly'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id)
    {

        
        $product = Product::where('id', $product_id)->first();
        if ($product) {
            $image_path = public_path('imgs/products/');
            $files_to_delete = Product_img::where('product_id', $product_id)
                ->pluck('img_url')
                ->all();

            foreach ($files_to_delete as $file) {
                $file_path = $image_path . $file;
                if (File::exists($file_path)) {
                    unlink($file_path);
                }
            }
        }

        Review::where('product_id', $product_id)->delete();
        Product_img::where('product_id', $product_id)->delete();
        Product::where('id', $product_id)->delete();
        return redirect()->back();
    }
}
