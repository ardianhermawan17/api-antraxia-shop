<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {

        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $oauthUser = Socialite::driver('google')->user();
        $user = User::where('google_id', $oauthUser->id)->first();

        if ($user) {
            Auth::loginUsingId($user->id);

            return redirect()->route('home');
        }
        else {
            $newUser = User::create([
                'name' => $oauthUser->name,
                'email' => $oauthUser->email,
                'google_id'=> $oauthUser->id,
                'username' => $oauthUser->name,
                'roles'  => json_encode(['CUSTOMER']),
                // password tidak akan digunakan
                'password' => md5($oauthUser->token),
            ]);
            Auth::login($newUser);

            return redirect()->route('home');
        }
    }
}
