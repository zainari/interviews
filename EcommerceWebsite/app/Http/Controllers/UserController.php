<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('admin.login_register_page.login');
    }
    public function showRegisterForm(){
        return view('admin.login_register_page.registeration');
    }
    
    public function register(UserRequest $request){
        // dd('here');
        $userData = $request->validated();
        
        User::create([
          'name'=>$userData['name'],
          'email'=>$userData['email'],
          'password'=>$userData['password'],
        ]);
       
        return redirect()->back()->with('success','Registration Successful. Please Login.');
    }

    public function login(Request $request){
    //    dd('here');
        $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['login_error' => 'Invalid email or password.']);
    // }
}

    public function logout(){
        Auth::logout();
        return redirect('/home');
    }

}