<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


}
