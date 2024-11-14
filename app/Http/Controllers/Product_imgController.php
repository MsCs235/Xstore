<?php

namespace App\Http\Controllers;

use App\Models\Product_img;
use Illuminate\Http\Request;

class Product_imgController extends Controller
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
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product_img $product_img)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product_img $product_img)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product_img $product_img)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_img $product_img)
    {
        //
    }
}
