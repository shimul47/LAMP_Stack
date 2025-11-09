<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResetToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetTokenController extends Controller
{
    public function getForget(){
        return view('auth.forget');
    }

    public function postForget(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            flash()->error("No user found");
            return redirect()->route("forget");
        }
        $token = Str::random(64);
        $prToken = PasswordResetToken::where('email', $user->email)->first();
        if($prToken){
            $prToken->token = $token;
        } else {
            $prToken = new PasswordResetToken();
            $prToken->email = $user->email;
            $prToken->token = $token;
        }
        $prToken->save();
        
        return route('password.reset', $token);
    }

    public function getReset($token){
        $prToken = PasswordResetToken::where('token', $token)->first();
        if(!$prToken){
            return redirect()->route('viewForget');
        }
        return view('auth.reset', ['token' => $token, 'email' => $prToken->email]);
    }

    public function postReset(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        PasswordResetToken::where('email', $request->email)->delete();
        flash()->success("Password reset successful");
        return redirect()->route('login');
    }
}
