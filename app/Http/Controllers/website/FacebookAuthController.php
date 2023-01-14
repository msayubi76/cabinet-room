<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callBackFacebook()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id',$facebook_user->id)->first();

            if (!$user) {
                $new_user = User::create([
                    'name' =>$facebook_user->name,
                    'email'=>$facebook_user->email,
                    'facebook_id'=>$facebook_user->id,
                    ]);
                Auth::login($new_user);
                return redirect()->intended('user-dashboard');    
            }
            else{
                Auth::login($user);
                return redirect()->intended('user-dashboard');    
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }

    }
}
