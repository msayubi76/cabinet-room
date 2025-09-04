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
use App\Services\RoleService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index()
    {

        try {
            $users = UserService::getUsers();
            $roles = RoleService::getRoles();

            return view('admin.user.index', compact('users','roles'));
        } catch (\Throwable $th) {

        }
    }
    public function profile()
    {


        return view('admin.user.userprofile');
    }

    public function store(UserRequest $request)

    {

        try {
            $user_response = UserService::store($request);


            return $user_response;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function update(UserRequest $request, User $user)
    {
        try {

            $user_response = UserService::update($request, $user);
            return $user_response;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            $user_response = UserService::destroy($id);
            return $user_response;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }


    public function updateinfo(UserRequest $request)
    {
        try {
            $user_response = UserService::update($request, auth()->user());
            return $user_response;
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }



    function changePassword(Request  $request)
    {

        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',


        ]);
        #Match The Old Password
        if (!Hash::check($request->oldpassword, auth()->user()->password)) {
            return response()->json(['status' => 0, 'msg' => 'Old Password Doesnt match!']);
        }
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['status' => 1, 'msg' => "Password changed successfully!"]);
    }
}
