<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function login()
    {
        return view('Auth.login');
    }

    public function check(SignInRequest $request)
    {
        $loginDatas = $request->only('email', 'password');
        if( Auth::attempt($loginDatas) )
            return redirect()->route('dashboard');

        return redirect()->route('login')->withErrors(['login' => 'Username or Password is incorrect']);
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function signup(SignUpRequest $request)
    {
        $user = new User();
        $userType = UserType::find(1);

        $founded = $user->where('email', $request->email);
        if ($founded->count() == 0) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->UTID = $userType->id;
            $user->save();

            return redirect()->route('login');
        }
        else{
            return redirect()->route('register');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }

    public function redirect($platform)
    {
        return Socialite::driver($platform)->redirect();
    }

    public function callback($platform)
    {
        $platformUser = Socialite::driver($platform)->user();
        $user = User::where('email', $platformUser->getEmail())->first();
        if( !$user ){
            $user->name = $platformUser->getName();
            $user->email = $platformUser->getEmail();
            $user->email_verified_at = now();
            $user->platform_token = $platformUser->token;
            $user->platform_refresh_token = $platformUser->refreshToken;
            $user->UTID = 1;
            $user->save();
        }
        Auth::login($user);

        return redirect()->route('dashboard.index');
    }
}
