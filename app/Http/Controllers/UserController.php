<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;



class UserController extends Controller
{

    public function index(){
        
        $users = UserService::getUsers();
        return view('admin.user.index',compact('users'));

    } 
    public function store(UserRequest $request){
        try {
            $user_obj = new UserService;
            $user_response = $user_obj->store($request);
            return $user_response; 

        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function update(UserRequest $request, User $sub_user){
        try {
           $user_obj = new UserService;
           $user_response = $user_obj->update($request,$sub_user);
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
}
