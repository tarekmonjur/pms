<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Company/CompanyController
    |--------------------------------------------------------------------------
    |
    | @Description : Company Management Controller
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
        $data['companies'] = Company::orderBy('id', 'desc')->get();
        return view('company.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'company_name' => 'required|max:100',
        ]);
        try {
            $company = new Company;
            $company->company_name = $request->company_name;
            $company->company_address = $request->company_address;
            $company->save();

            $request->session()->flash('msg_success', 'Company successfully added.');
            return redirect('company');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Company not added.');
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
        $data['company'] = Company::find($id);
        return view('company.edit')->with($data);
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
            'company_name' => 'required|max:255',
        ]);
        try {
            $company = Company::find($id);
            $company->company_name = $request->company_name;
            $company->company_address = $request->company_address;
            $company->save();

            $request->session()->flash('msg_success', 'Company successfully updated.');
            return redirect('company');
        }catch(\Exception $e){
            $request->session()->flash('msg_error', 'Company not updated.');
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
            Company::where('id', $id)->delete();
            $request->session()->flash('msg_success', 'Company successfully deleted.');
            return redirect()->back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'Company not deleted. Maybe its relation another data.');
            return redirect()->back();
        }
    }
}
