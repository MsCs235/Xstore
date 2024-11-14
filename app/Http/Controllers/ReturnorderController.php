<?php

namespace App\Http\Controllers;

use App\Models\Returnorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReturnReturnorder;
use App\Models\Requestt;
use Illuminate\Support\Facades\DB;
class ReturnorderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $item = DB::table('orders')
            ->join('returnorders', 'orders.id', '=', 'returnorders.order_id')
            ->where('orders.user_id', Auth::user()->id)
            ->where('orders.status', 'RequestReturn')
            ->get();

        // $requests = Requestt::where('user_id' , Auth::user()->id)->get();

        return view('layouts.returns',compact('item'));
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Returnorder $returnorder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Returnorder $returnorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Returnorder $returnorder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Returnorder $returnorder)
    {
        //
    }
}
