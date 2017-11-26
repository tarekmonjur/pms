<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Company/DepartmentController
    |--------------------------------------------------------------------------
    |
    | @Description : Department Management Controller
    | @Author : IDDL.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    protected $auth;

    public function __construct()
    {
        $this->middleware('auth');
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
        $data['departments'] = Department::with('company')->orderBy('id', 'desc')->get();
        return view('department.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['companies'] = Company::orderBy('id', 'desc')->get();
        return view('department.create')->with($data);
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
            'company_name' => 'required',
            'department_name' => 'required|max:100',
        ]);
        try {
            $chekcDepartment = Department::where('company_id', $request->company_name)
                ->where('department_name', $request->department_name)
                ->first();
            if($chekcDepartment){
                $department = $chekcDepartment;
            }else {
                $department = new Department;
            }
            $department->company_id = $request->company_name;
            $department->department_name = $request->department_name;
            $department->save();

            $request->session()->flash('msg_success', 'Department successfully added.');
            return redirect('department');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Department not added.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['department'] = Department::find($id);
        $data['companies'] = Company::orderBy('id', 'desc')->get();
        return view('department.edit')->with($data);
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
            'company_name' => 'required',
            'department_name' => 'required|max:100',
        ]);
        try {
            $department = Department::find($id);
            $department->company_id = $request->company_name;
            $department->department_name = $request->department_name;
            $department->save();

            $request->session()->flash('msg_success', 'Department successfully updated.');
            return redirect('department');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Department not updated.');
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
            Department::where('id', $id)->delete();
            $request->session()->flash('msg_success', 'Department successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Department not deleted.');
            return redirect()->back();
        }
    }
}
