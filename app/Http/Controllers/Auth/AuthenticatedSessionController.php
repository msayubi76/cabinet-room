<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Socialite\Facades\Socialite;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

     // Google login
     public function redirectToGoogle(Request $request)
     {
         return Socialite::driver('google')->redirect();

     }

     // Google callback
     public function handleGoogleCallback(Request $request)
     {
         $userdata = Socialite::driver('google')->user();
         $user = User::where('email',$userdata->email)->where('auth_type','google')->first();
         if($user)
         {
            Auth::login($user);

            return redirect('/');
         }
         else{
            $uuid =Str::uuid()->toString();
            $user = new User();
            $user->name = $userdata->name;

            $user->email = $userdata->email;
            $user->password = Hash::make($uuid.now());
            $user->auth_type = 'google';
            $user->save();
         }



     }

     // Facebook login
     public function redirectToFacebook(Request $request)
     {
         return Socialite::driver('facebook')->redirect();
     }

     // Facebook callback
     public function handleFacebookCallback(Request $request)
     {
         $userdata = Socialite::driver('facebook')->user();

         $user = User::where('email',$userdata->email)->where('auth_type','facebook')->first();
         if($user)
         {
            Auth::login($user);

            return redirect('/');
         }
         else{
            $uuid =Str::uuid()->toString();
            $user = new User();
            $user->name = $userdata->name;

            $user->email = $userdata->email;
            $user->password = Hash::make($uuid.now());
            $user->auth_type = 'facebook';
            $user->save();
         }
     }


}
