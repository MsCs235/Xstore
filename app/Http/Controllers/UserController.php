<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
    public function show(User $User)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $password = $request->password;
        $newpassword = $request->newpassword;
        $confirmpassword = $request->confirmpassword;

        if(Hash::check($password, Auth::user()->password)){
            if ($newpassword !== $confirmpassword) {
                return redirect(route('userprofile'))->with('error','new password not match with confirm password');
            }else{
                $hashNewPassword = $this->hashpass($newpassword);
                User::where('id', Auth::user()->id)
                    ->update([
                        'password' => $hashNewPassword,
                    ]);
                return redirect(route('userprofile'))->with('success','Password Reseted');    
            }

        }else{
            return redirect(route('userprofile'))->with('error','old password not correct');
        }

    }


    function hashpass($newPassword){
         // Hash the new password
         $hashedPassword = Hash::make($newPassword);

         return $hashedPassword;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User)
    {

        $user_id = Auth::user()->id;

        User::where('id',$user_id )
            ->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

        return redirect(route('userprofile'))->with('success','Product Updated Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        //
    }
}
