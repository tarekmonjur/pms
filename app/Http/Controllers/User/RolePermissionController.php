<?php

namespace App\Http\Controllers\User;

use App\Models\RolePermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RolePermissionController extends Controller
{
    /*
     |--------------------------------------------------------------------------
     | User/RolePermissionController
     |--------------------------------------------------------------------------
     |
     | @Description : User Role Permission Management Controller
     | @Author : IDDL.
     | @Email  : tarekmonjur@gmail.com
     |
     */

    protected $auth;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission');
        $this->middleware(function($request, $next){
            $this->auth = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = RolePermission::orderBy('id', 'desc')->get();
        return view('role.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|max:255',
        ]);
        try {
            $rolePermission = new RolePermission();
            $rolePermission->role_name = $request->role_name;
            $rolePermission->role_description = $request->role_description;
            $rolePermission->role_permission = serialize($request->permissions);
            $rolePermission->save();

            $request->session()->flash('msg_success', 'Role successfully added.');
            return redirect('roles');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Role not added.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['role'] = RolePermission::find($id);
        return view('role.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['role'] = RolePermission::find($id);
        return view('role.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|max:255',
        ]);
        try {
            $rolePermission = RolePermission::find($id);
            $rolePermission->role_name = $request->role_name;
            $rolePermission->role_description = $request->role_description;
            $rolePermission->role_permission = serialize($request->permissions);
            $rolePermission->save();

            $request->session()->flash('msg_success', 'Role successfully updated.');
            return redirect('roles');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Role not updated.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try{
            RolePermission::where('id', $id)->delete();
            $request->session()->flash('msg_success', 'Role successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Role not deleted. Maybe its relation another data.');
            return redirect()->back();
        }
    }
}
