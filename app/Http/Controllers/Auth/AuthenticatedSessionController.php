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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Check if user exists and registered with Google
        $user = User::where('email', $request->email)->first();
    
        
    
        // Regular email/password authentication
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    
        if ($user && $user->google_id !==null) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'This account was created with Google. Please use "Login with Google" button.',
                ]);
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
    try {
        // If user is already logged in, link Google account or show message
        if (Auth::check()) {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $currentUser = Auth::user();
            
            // Check if Google account is already linked to another user
            $existingGoogleUser = User::where('google_id', $googleUser->getId())->first();
            
            if ($existingGoogleUser && $existingGoogleUser->id !== $currentUser->id) {
                return redirect('/')->with('error', 'This Google account is already linked to another account.');
            }
            
            // Link Google account to current logged in user
            $currentUser->update([
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'auth_type' => 'both', // or keep existing and add google
            ]);
            
            return redirect('/')->with('success', 'Google account linked successfully!');
        }
        
        // Normal login flow for non-logged in users
        $googleUser = Socialite::driver('google')->stateless()->user();
        
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Update Google credentials
            $user->update([
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
        } else {
            // Create new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
                'google_id' => $googleUser->getId(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'auth_type' => 'google',
                'email_verified_at' => now(),
                'requires_password_setup' => true,
            ]);
        }

        Auth::login($user);
        return redirect('/');

    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
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
