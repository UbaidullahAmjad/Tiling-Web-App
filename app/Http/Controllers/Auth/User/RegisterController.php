<?php

namespace App\Http\Controllers\Auth\User;


use App\{
    Http\Requests\UserRequest,
    Http\Controllers\Controller,
    Repositories\Front\UserRepository
};
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Str;


class RegisterController extends Controller
{

    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\UserRepository $repository
     *
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function showForm()
    {
      return view('user.auth.register');
    }


    public function register(UserRequest $request)
    {   
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);
        $this->repository->register($request);
        Session::flash('success',__('Account Register Successfully please login'));
        return redirect()->back();
        
    }


    public function registerAjax(UserRequest $request){
        // dd($request->all());
        $getuser = User::where('email',$request->email)->first();
        // $request->validate([
        //     'email' => 'required|email|unique:users,email'
        // ]);
        if($getuser){
            return response()->json('exist');
        }
        // $input = $request->all();
        
        $user = new User;
        $fill = $user->getFillable();
        $input = $request->only($fill);
        $u = $user->create($input);
        
        $verify = Str::random(6);
        $u->password = Hash::make($request['password']);
        $u->email_token = $verify;
        $u->save();
        
        $us = $this->getLogin($u,$request->password);
        if($us){
            return response()->json($us);
        }else{
            return response()->json('false');
        }
        

    }

    public function getLogin($user,$password){
        
        if (Auth::attempt(['email' => $user->email, 'password' => $password])) {
        
            $user = Auth::user();
            // dd($user);
            return $user;
            
            
    
          }
    }
    


    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();
       
        if($user){
            
            Auth::login($user);
            
            return redirect(route('user.dashboard'));
        }else{
            return redirect(route('user.login'));
        }
    }



}
