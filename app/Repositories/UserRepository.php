<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Traits\FileUploadTrait;
use App\User;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{
    use FileUploadTrait;

    public function getUsers()
    {
        try {
          return  User::all();
        } catch (\Exception $e) {
            return $e;
        }
    } 
    public function createUser($request)
    {
        try {
            DB::beginTransaction();
            $create_request = $request->except('_token');
            $create_request['password'] = Hash::make($create_request['password']);
            $create_request['is_active'] = true;
            $user=User::create($create_request);

            if( $request->user_type == "customer" ):
                $user->update(['customer_id'=>sprintf('%05d', $user->id)]);
                $user->assignRole("Customer");
            endif;
 
            DB::commit();
            if( !empty($request->roles) ):
                return $this->manageRoles($request->roles, $user);
             endif;
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function manageRoles($request, $user)
    {
        try {
            $user->syncRoles($request);
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function getUserById($id)
    {
        try {
            $user = User::find($id);
            return $user;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updateUser($request, $id){
        try { 
            DB::beginTransaction(); 
            $update_request = $request->except('_token','_method'); 

            if ($request->hasFile('file')){
               
                $image =  $this->fileUpload( $request->file('file'), 'users' );
                $update_request['image'] = $image;
             }

            $user=User::find($id); 
            $user->update($update_request);

       

            
            
            $userss=User::find($id); 
            $this->manageRoles($request->roles, $userss);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function updateStatus( $id){
        try {
            $message=false;
            DB::beginTransaction();
            $user = User::find($id);
            if($user->is_active){
                $update_request['is_active'] = 0;
                $message="User has been de active";
            }else{
                $update_request['is_active'] = 1;
                $message="User has been active";
            }
            $user =  $user->update($update_request);
            DB::commit();
            return $message;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function deleteUser($id){
        try {
            DB::beginTransaction();
             User::find($id)->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function getRoles(){
        try { 
            return Role::all(); 
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function updatePssword($request){
        try { 
            DB::beginTransaction();  
            $update_request = $request->except('_token','_method'); 
            $update_request['password'] = Hash::make($update_request['password']);
            $user = User::find($request->id);
            if($user):
                $user = $user->update($update_request);
            endif;
            DB::commit();
            return true;
           
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function changePassword($request){
        try { 
            DB::beginTransaction();  
             $update_request = $request->except('_token','_method');
             $user = User::find($request->id);
            if($user){
                if(Hash::check($request->current_password, $user->password)){
                     $update_request['password'] = Hash::make($request->new_password);
                     $user = $user->update($update_request);
                }else{
                    return false;
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
    public function updateUserProfile($request, $id){
        try { 
            DB::beginTransaction(); 
            $update_request = $request->except('_token','_method');
            $user=User::find($id);
            if ($request->hasFile('file')){
                if($user->image!=null){
                    $this->fileDeleted( $user->image, 'users' );
                }
                $image =  $this->fileUpload( $request->file('file'), 'users' );
                $update_request['image'] = $image;
            }

            $user->update($update_request); 
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}
