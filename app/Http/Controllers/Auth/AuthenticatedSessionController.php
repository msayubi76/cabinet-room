<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
     public function redirectToGoogle()
     {
         return Socialite::driver('google')->redirect();
     }
 
     // Google callback
     public function handleGoogleCallback()
     {
         $user = Socialite::driver('google')->user();
 
         $this->_registerOrLoginUser($user);
 
         // Return home after login
         return redirect()->route('/');
     }
 
     // Facebook login
     public function redirectToFacebook()
     {
         return Socialite::driver('facebook')->redirect();
     }
 
     // Facebook callback
     public function handleFacebookCallback()
     {
         $user = Socialite::driver('facebook')->user();
 
         $this->_registerOrLoginUser($user);
 
         // Return / after login
         return redirect()->route('/');
     }
}
