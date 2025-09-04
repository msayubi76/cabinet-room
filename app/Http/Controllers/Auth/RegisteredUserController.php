<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create($product_id=null)
    {
        return view('auth.register',compact('product_id'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [ 'required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'mobile_no' => ['nullable'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable'],
            'region' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'city' => $request->city,
            'region' => $request->region,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
        if (isset($request->product_id)) {
           return redirect()->route('website.single-product',$request->product_id);
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
