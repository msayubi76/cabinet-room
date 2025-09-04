<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class FacebookAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callBackFacebook()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();
            dd($facebook_user);
            $userData = $facebook_user->user;
            $user = User::where('email',$userData['email'])->orwhere('facebook_id',$facebook_user->id)->first();
            if (!$user) {
                $date = Carbon::now();
                $date =date_format($date,"Y-m-d H:i:s");
                $new_user = User::create([
                    'facebook_id'=>$userData->id,
                    'name' =>$userData['given_name'],
                    'last_name' =>$userData['family_name'],
                    'email'=>$userData->email,
                    'facebook_id'=>$userData['id'],
                    'email_verified_at'=>$userData['email_verified']==true? $date:'',
                    'type'=>'customer',

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
