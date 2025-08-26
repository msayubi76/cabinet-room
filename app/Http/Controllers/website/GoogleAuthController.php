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
use Illuminate\Support\Facades\Session;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        Session::put('prevUrl', url()->previous());
        return Socialite::driver('google')->redirect();
    }

    public function callBackGoogle()
    {
       
        $google_user = Socialite::driver('google')->user();
        $userData = $google_user->user;
        $user = User::where('email', $google_user->getEmail())->orwhere('google_id', $google_user->getId())->first();

        $prevUrl = Session::get('prevUrl');
        $prevUrl = $prevUrl ? $prevUrl : 'user-dashboard';


        if (!$user) {
            $date = Carbon::now();
            $date = date_format($date, "Y-m-d H:i:s");
            // if ($userData['picture']) :
            //     $fileContents = file_get_contents($userData['picture']);
            //     $image_name = $google_user->getId() . ".jpg";
            //     Storage::put( $image_name, $fileContents);
            //     $new_user['folder_name'] = 'profile';
            //     $new_user['image_name'] =  $image_name;
            //     $new_user['image_url'] = url('/storage/profile/' . $image_name);
            // endif;
            $new_user = User::create([
                'name' => $userData['given_name'],
                'last_name' => $userData['family_name'],
                'email' => $google_user->getEmail(),
                'google_id' => $userData['id'],
                'email_verified_at' => $userData['email_verified'] == true ? $date : '',
                'type' => 'customer',
            ]);
            Auth::login($new_user);
            return redirect()->intended($prevUrl);
        } else {
            Auth::login($user);
            return redirect()->intended($prevUrl);
        }
    }
}
