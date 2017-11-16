<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Hospital;
use App\Models\Department;

use Validator;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User/Admin Controller
    |--------------------------------------------------------------------------
    |
    | @Description : Application User Manage
    | @Author : IDDL.
    | @Email  : tarekmonjur@gmail.com
    |
    */

    public function __construct(){
        $this->middleware('auth');
    }


    public function __invoke()
    {
        $data['users'] = User::all();
        return view('user.index')->with($data);
    }


    public function edit($id){
        $data['user'] = User::find($id);
        $data['hospitals'] = Hospital::get();
        $data['departments'] = Department::get();
        return view('user.edit')->with($data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'hospital_id' => 'required',
            'department_id' => 'required',
            'firstname' => 'required|max:45|min:3|alpha',
            'lastname' => 'required|max:45|min:3|alpha',
            'designation' => 'required|max:45|min:3',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|max:20',
            'mobile_no' => 'required|max:17|min:11|regex:/\+*[0-9]+$/',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        try {
            if($request->hasFile('image')){
                $photo_name = time().'.'.$request->image->extension();
                $upload_path = public_path('images/user');
                $request->image->move($upload_path, $photo_name);
                $request->offsetSet('photo', $photo_name);
            }

            $user = User::find($request->id);
            if($user->photo){
                if(isset($photo_name)){
                    File::delete($upload_path.'/'.$user->photo);
                }
            }

            $user->update($request->all());
            $request->session()->flash('msg_success', 'User successfully updated.');
            return redirect('user');
        }catch (\Exception $e){
            $request->session()->flash('msg_error', 'User not updated.');
            return redirect()->back();
        }
    }


    public function delete($id){
        try{
            User::find($id)->delete();
            session()->flash('msg_success', 'User successfully deleted.');
        }catch (\Exception $e){
            session()->flash('msg_error', 'User not deleted.');
        }
        return redirect()->back();
    }




}
