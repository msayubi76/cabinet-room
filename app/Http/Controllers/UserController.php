<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Http\Requests\UserRequest\ChangePasswordRequest;
 


use App\Http\Requests\UserRequest\CreateUserRequest;
use App\Http\Requests\UserRequest\EditUserRequest;
use App\Http\Requests\UserRequest\UpdatePasswordRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{ 
    private $UserRepository;
    private $countries;
    public function __construct(UserRepository $UserRepository)
    { 
        $this->middleware('permission:user.list',['only'=>['index']]); 
        $this->middleware('permission:user.create', ['only' => ['create','store']]);
        $this->middleware('permission:user.update', ['only' => ['edit','update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    

        $this->middleware('auth')->except(['storeCustomer', 'createCustomer']);;  
        $this->UserRepository = $UserRepository;
        
        $this->countries = Config::get('countries.countries');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->UserRepository->getUsers(); 
        return view('user.index',compact('users'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->UserRepository->getRoles();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {  
        $user = $this->UserRepository->createUser($request);
       
        if ($user instanceof \Exception) {
            return redirect('user')->with('error', $user->getMessage());
        }
  
            return redirect(url("user"))->with('success', 'User has been Created');
    }
    public function createCustomer() 
    {    
        $countries = $this->countries;
        return view('user.customer_create', compact('countries'));
    }

    public function storeCustomer(CreateUserRequest $request)
    {    
        
        $user = $this->UserRepository->createUser($request);
        
        if ($user instanceof \Exception) {
            return redirect('home')->with('error', $user->getMessage());
        }
        
        event(new SendEmailEvent($user->email,null, false, "registrition", $user));
        return redirect('login')->with('success', 'Account created succesfully. please login to proceed');
    }
 
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        
        $roles = $this->UserRepository->getRoles();
        $user = $this->UserRepository->getUserById($id); 
        if ($user instanceof \Exception) {
            return redirect('user')->with('error', $user->getMessage());
        }
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {  
        $id = decrypt($id);
        $user = $this->UserRepository->updateUser($request,$id); 
        if ($user instanceof \Exception) {
            return redirect('user')->with('error', $user->getMessage());
        }
        return redirect('user')->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $user =  $this->UserRepository->deleteUser($id);
        
        if ($user instanceof \Exception) {
            return response()->json(['status' => false, 'error' => $user->getMessage()]);
        }
        return response()->json(['status' => true, 'success' => 'User has been deleted successfully']);
    }
    public function updatePssword(UpdatePasswordRequest $request)
    {
        $id = decrypt($request->id);
        $request['id'] = $id;
        $password =  $this->UserRepository->updatePssword($request); 
        if ($password instanceof \Exception) {
            return response()->json(['status' => false, 'error' => $password->getMessage()]);
        }
        return response()->json(['status' => true, 'success' => 'Password has been changed successfully']);
    }
    public function updateStatus($id)
    {
       $id = decrypt($id);
        $status =  $this->UserRepository->updateStatus($id); 
        if ($status instanceof \Exception) {
            return response()->json(['status' => false, 'error' => $status->getMessage()]);
        }
        if($status){
            return response()->json(['status' => true , 'msg' => $status]);
        }
        return response()->json(['status' => false, 'error' => "Something want wrong"]);
    }

    public function changePassword()
    { 
        return view('user.change-password'); 
    }
    public function saveChangePassword( ChangePasswordRequest $request )
    { 
        $id = decrypt($request->id); 
        $request['id'] = $id;
        $password =  $this->UserRepository->changePassword($request);
       
        if ($password instanceof \Exception) {
            return response()->json(['status' => false, 'error' => $password->getMessage()]);
        }
        if(!$password){
            return response()->json(['status' => false, 'msg' => "Invalid old password"]);  
        }else if($password){
            return response()->json(['status' => true, 'msg' => "Password changed!"]); 
        } 
    }
    
    public function editProfile($id)
    { 
        $id = decrypt($id);
        $user = $this->UserRepository->getUserById($id);
        if ($user instanceof \Exception) {
            return redirect('user')->with('error', $user->getMessage());
        }
        return view('user.edit-profile',compact('user'));
    }
    public function updateProfile(EditUserRequest $request, $id)
    { 
       
        $id = decrypt($id);
        $user = $this->UserRepository->updateUserProfile($request,$id); 
        if ($user instanceof \Exception) {
            return redirect('/dashboard')->with('error', $user->getMessage());
        }
        return redirect('/dashboard')->with('success', 'Profile updated');
    }

    public function findCustomer(Request $request)
    { 
        try{
            { 
                $query = $request->get('query');
                $data = User::where('id', '<>', 1)
                    ->where('is_active', '<>', 0)
                    ->orderBy('id', 'desc');

                $data =  $data->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('customer_id', 'LIKE', "%{$query}%")->get();

                $output = '<ul class="dropdown-menu text-capitalize; " style="display:block;width: 100%;">';
                
                foreach($data as $row)
                {   
                    $output .= '<li data-customer_id="'.$row->id.'" ><a   class="dropdown-item" href="#" >'.$row->customer_id.'/</br> '.$row->name.'</a></li>';
                }
                if(count($data) == 0):
                    $message = "Customer not found.";
                    $output .= '<li   ><a   class="dropdown-item" href="#" >'.$message.'</a></li>';
                endif;
                $output .= '</ul>';
                
                return response()->json(['success' =>true, 'html'=> $output ]);

            }
        }catch (\Exception $e){
            return response()->json(['success' =>false, 'msg' =>  $e->getMessage()]);
        }
    }
}