<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use FileUploadTrait;

    public static function getUsers()
    {
        try {
            $users = User::all();
            return $users;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function store(UserRequest $request) 
    {
        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('profile')) :
            $image_name = $this->fileUpload($request->profile, 'profile');
            $data['folder_name'] = 'profile';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/profile/' . $image_name);
        endif;
        $data['password'] = Hash::make($request->password);
        $data['type'] = 'admin';
        $user = User::create($data);
        DB::commit();
        $response = ['status' => true, 'message' => 'Sub user added successfully.', 'user' => $user];

        return $response;
    }
    public function update(UserRequest $request, User $sub_user){
        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('profile')) :
            $image_name = $this->fileUpload($request->profile, 'profile');
            $data['image_floder'] = 'profile';
            $data['profile_photo'] =  $image_name;
            
            $data['profile_photo_path'] = url('/storage/profile/' . $image_name);
        endif;
        $sub_user->update($data);
        $sub_user->load('roles');

        DB::commit();
        $response = ['status' => true, 'message' => 'Sub user updated.', 'sub_user' => $sub_user];
        return $response;
    }
    public static function destroy($id)
    {
        DB::beginTransaction();
        $user = User::findorFail($id);
        $user->delete();
        DB::commit();
        $response = ['status' => true, 'message' => 'Sub user removed successfully.'];
        return $response;
    }
}
