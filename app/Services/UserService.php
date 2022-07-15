<?php

namespace App\Services;

use App\Models\User;
use App\Traits\FileUploadTrait;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use FileUploadTrait;

    public static function getUsers()
    {

            $users = User::orderBy('id', 'DESC')->paginate(30);
            return $users;

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
    public function update(UserRequest $request, User $user){
        DB::beginTransaction();
        $data = $request->validated();

        $user->update($data);


        DB::commit();
        $response = ['status' => true, 'message' => 'Sub user updated.', 'sub_user' => $user];
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
