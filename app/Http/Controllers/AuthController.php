<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Mailer\Transport\Dsn;

class AuthController extends Controller{

    public function showSignup(){
        return view('auth.signup');
    }

    public function signup(Request $request){
        $valid = $request->validate([
            'name' => 'required',
            'email' => 'required| email | unique:users,email',
            'password' => 'required | confirmed | min:8',
        ]);
        $valid['password'] = Hash::make($valid['password']);
        $user = User::create($valid);
        Auth::login($user);
         
        //Previous Sign Up
        // Signup::create([
        //     'email' => $request->email,
        //     'username' => $request->username,
        //     'password' => Hash::make($request->password),//hash::make hash::check
        // ]);
        flash()->success('SignUp Successfull');
        return redirect()->route('login');
    }

    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $valid = $request->validate([
            'email' => 'required | email',
            'password' => 'required',
        ]);
        if(Auth::attempt($valid)){
            $request->session()->regenerate();
            flash()->success("You are successfully logged in");
            return redirect()->route("home");
        }

        // $user = Signup::where('username', $request->username)->first();

        // if ($user && Hash::check($request->password, $user->password)){
        //     session(['username' => $user->username]);
        //     return redirect()->route('home');
        // }

        return back()->withErrors(['login_error' => 'Invalid username or password']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        flash()->success('Logout Successful');
        return redirect()->route("login");
    }

}