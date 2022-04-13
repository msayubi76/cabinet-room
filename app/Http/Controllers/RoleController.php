<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest\RoleCreateRequest;
use App\Http\Requests\RoleRequest\RoleUpdateRequest;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    private $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
        $this->middleware('permission:role.list',['only'=>['index']]); 
        $this->middleware('permission:role.view',['only'=>['show']]);
        $this->middleware('permission:role.create', ['only' => ['create','store']]);
        $this->middleware('permission:role.update', ['only' => ['edit','update']]);
        $this->middleware('permission:role.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->getRoles();
        if ($roles instanceof \Exception) {
            return redirect('role')->with('error', $roles->getMessage());
        }
        return view('roles.roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->roleRepository->getAllPermission();
        if ($permissions instanceof \Exception) {
            return redirect('role')->with('error', $permissions->getMessage());
        }
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $role = $this->roleRepository->createRole($request); 
 
        if ($role instanceof \Exception) {
            return redirect('role')->with('error', $role->getMessage());
        }
        return redirect('role')->with('success', 'User Role has been Created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back()->with('error', 'Something wrong URL hit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = decrypt($id);
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->roleRepository->getAllPermission();
        if ($role instanceof \Exception) {
            return redirect('role')->with('error', $role->getMessage());
        }
        return view('roles.update', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $id = decrypt($id); 
        $role = $this->roleRepository->updateRole($request, $id); 
        if ($role instanceof \Exception) {
            return redirect('role')->with('error', $role->getMessage());
        }
        return redirect('role')->with('success', 'User Role has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = decrypt($id);
        $role =  $this->roleRepository->deleteRole($id);
        if ($role instanceof \Exception) {
            return response()->json(['status' => false, 'error' =>$role->getMessage()]);
        }
        return response()->json(['status' => true, 'success' => 'Role has been Deleted']);
    }
}
