<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest\PermissionCreateRequest;
use App\Http\Requests\PermissionRequest\PermissionUpdateRequest;
use App\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    private $PermissionRepository; 
    
    public function __construct(PermissionRepository $PermissionRepository)
    {
        $this->middleware('auth');
        $this->PermissionRepository = $PermissionRepository;
        $this->middleware('permission:permission.list',['only'=>['index']]); 
        $this->middleware('permission:permission.view',['only'=>['show']]);
        $this->middleware('permission:permission.create', ['only' => ['create','store']]);
        $this->middleware('permission:permission.update', ['only' => ['edit','update']]);
        $this->middleware('permission:permission.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $permissions = $this->PermissionRepository->getPermissions();
        if ($permissions instanceof \Exception) {
            return redirect('permission')->with('error', $permissions->getMessage());
        }
        return view('permissions.permissions', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        return view('permissions.create');
    }

    
    public function store(PermissionCreateRequest $request)
    {
        $permission = $this->PermissionRepository->createPermission($request); 
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return redirect('permission')->with('success', 'User Permission has been Created');
    }

    /**
     * Display the specified resource.
     * 
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $permission = $this->PermissionRepository->getPermissionById($id);
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return view('permissions.update', compact('permission'));
    }
 
    public function update(PermissionUpdateRequest $request, $id)
    {
        $id = decrypt($id);
        $permission = $this->PermissionRepository->updatePermission($request, $id);
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return redirect('permission')->with('success', 'User Permission has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     * 
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $permission =  $this->PermissionRepository->deletePermission($id);
        if ($permission instanceof \Exception) {
            return response()->json(['status' => false, 'error' =>$permission->getMessage()]);
        }
        return response()->json(['status' => true, 'success' => 'Permission has been Deleted']);
    }
    
    public function assignPermission($id)
    { 
        $id = decrypt($id);
        $roles = $this->PermissionRepository->roles();
        $permissions = $this->PermissionRepository->getAllPermission();
        $user = $this->PermissionRepository->getUser($id);
        if ($roles instanceof \Exception) {
            return redirect('role')->with('error', $roles->getMessage());
        }
        return view('permissions.assign-permission', compact('roles', 'permissions', 'user' ));
    }
    public function saveAssignPermission(Request $request)
    {
        $user_id = decrypt($request->user_id);
        $permission = $this->PermissionRepository->saveAssignPermission($request,$user_id);
        if ($permission instanceof \Exception) {
            return redirect('permission')->with('error', $permission->getMessage());
        }
        return redirect('user')->with('success', 'Role/Permission Created');
    }
}
