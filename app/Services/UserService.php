<?php

namespace App\Services;

use App\Models\User;
use App\Traits\FileUploadTrait;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserService
{
    use FileUploadTrait;

    public static function getUsers()
    {
        $users = User::orderBy('id', 'DESC')
                ->whereNotIn('type', ['super-admin'])
                ->paginate(30);
        return $users;
    }

    public static function store(UserRequest $request)
    {

        DB::beginTransaction();
        $data = $request->validated();
        if ($request->hasFile('profile')) :
            $image_name = FileUploadTrait::fileUpload($request->profile, 'profile');
            $data['folder_name'] = 'profile';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/profile/' . $image_name);
        endif;
        $data['password'] = Hash::make($request->password);
        $data['type'] = 'admin';




        $user = User::create($data);
        $user->syncRoles($request->roles);


        DB::commit();
        $response = ['status' => true, 'message' => 'Sub user added Successfully.', 'user' => $user];
        return $response;
    }

    public  static function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        $data = $request->validated();
         if ($request->hasFile('profile')) :
            $image_name = FileUploadTrait::fileUpload($request->profile, 'profile');
            $data['folder_name'] = 'profile';
            $data['image_name'] =  $image_name;
            $data['image_url'] = url('/storage/profile/' . $image_name);
        endif;
        $user->update($data);
        $user->syncRoles($request->roles);
        DB::commit();
        $response = ['status' => true, 'message' => ' User profile updated successfully.', 'user' => $user];
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
