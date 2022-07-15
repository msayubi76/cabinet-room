<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChangePasswordRequest;





class UserController extends Controller
{

    public function index(){

        $users = UserService::getUsers();
        return view('admin.user.index',compact('users'));

    }
    public function profile(){

        return view('admin.user.userprofile');
    }





    // function changePassword(Request $request){
    //     //Validate form
    //     $validator = Validator::make($request->all(),[
    //         'oldpassword'=>[
    //             'required', function($attribute, $value, $fail){
    //                 if( !\Hash::check($value, Auth::user()->password) ){
    //                     return $fail(__('The current password is incorrect'));
    //                 }
    //             },
    //             'min:8',
    //             'max:30'
    //          ],
    //          'newpassword'=>'required|min:8|max:30',
    //          'cnewpassword'=>'required|same:newpassword'
    //      ],[
    //          'oldpassword.required'=>'Enter your current password',
    //          'oldpassword.min'=>'Old password must have atleast 8 characters',
    //          'oldpassword.max'=>'Old password must not be greater than 30 characters',
    //          'newpassword.required'=>'Enter new password',
    //          'newpassword.min'=>'New password must have atleast 8 characters',
    //          'newpassword.max'=>'New password must not be greater than 30 characters',
    //          'cnewpassword.required'=>'ReEnter your new password',
    //          'cnewpassword.same'=>'New password and Confirm new password must match'
    //      ]);

    //     if( !$validator->passes() ){
    //         return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
    //     }else{

    //      $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

    //      if( !$update ){
    //          return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
    //      }else{
    //          return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
    //      }
    //     }
    // }


    public function store(UserRequest $request){
        try {
            $user_obj = new UserService;
            $user_response = $user_obj->store($request);
            return $user_response;

        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(UserRequest $request, User $user){
        try {
           $user_obj = new UserService;
           $user_response = $user_obj->update($request,$user);
           return $user_response;
        } catch (\Throwable $th) {
           return $th;
        }
    }
    public function destroy($id){
       try {
            $user_response = UserService::destroy($id);
            return $user_response;
       } catch (\Throwable $th) {
           return $th;
       }
    }

    public function updateinfo(UserRequest $request){
        try {
           $user_obj = new UserService;
           $user_response = $user_obj->update($request,auth()->user());
           return $user_response;
        } catch (\Throwable $th) {
           return $th;
        }
    }



function changePassword(Request  $request){

    $request->validate([
        'oldpassword'=>'required',
        'password' => 'required|confirmed',


    ]);
     #Match The Old Password
     if(!Hash::check($request->oldpassword, auth()->user()->password)){
        return response()->json(['status'=>0,'msg'=> 'Old Password Doesnt match!']);

    }
 #Update the new Password
 User::whereId(auth()->user()->id)->update([
    'password' => Hash::make($request->password)
]);

return response()->json(['status'=>1,'msg'=> "Password changed successfully!"]);
}
}
