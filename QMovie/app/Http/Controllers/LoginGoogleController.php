<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginGoogleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
            // Check users email if already there
            $finduser = User::where('email', $user->getEmail())->first();
    
            if(!$finduser){
                $newUser = User::updateOrCreate(
                    [
                    'google_id'=> $user->getId()
                    ],
                    [
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => 'user',
                        'password' => encrypt('123456dummy')
                    ]
                );
    
            }else{
                $newUser = User::where('email', $user->getEmail())->update([
                    'google_id'=> $user->getId(),
                ]);
                $newUser = User::where('email', $user->getEmail())->first();
            }

            Auth::loginUsingId($newUser->id);
    
            // Kiểm tra vai trò của người dùng
            if ($newUser->role === 'admin') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
