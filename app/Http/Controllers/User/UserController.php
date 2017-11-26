<?php

namespace App\Http\Controllers\User;

use App\Models\Department;
use App\Models\User;

use Illuminate\Support\Facades\File;
use Validator;
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
        $data['users'] = User::with('department')->orderBy('id','desc')->get();
        return view('user.index')->with($data);
    }


    public function edit($id){
        $data['user'] = User::find($id);
        $data['departments'] = Department::with('company')->get();
        return view('user.edit')->with($data);
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:45|min:3|alpha_spaces',
            'last_name' => 'required|max:45|min:3|alpha_spaces',
            'department_name' => 'required',
            'designation' => 'required|max:45|min:3|alpha_spaces_dot',
            'email' => 'required|email|max:100|unique:users,id,'.$request->id,
            'password' => 'nullable|min:6|max:20',
            'user_type' => 'required',
            'mobile_no' => 'required|max:11|min:11|regex:/\+*[0-9]+$/',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        try {
            if($request->hasFile('image')){
                $photo_name = time().'.'.$request->image->extension();
                $upload_path = public_path('uploads/users');
                $request->image->move($upload_path, $photo_name);
                $request->offsetSet('photo', $photo_name);
            }

            $user = User::find($request->id);
            if($user->photo){
                if(isset($photo_name)){
                    File::delete($upload_path.'/'.$user->photo);
                }
            }

            if(empty($request->password)){
               $request->offsetUnset('password');
            }
            $request->offsetSet('department_id', $request->department_name);
            $request->offsetUnset('department_name');
            $user->update($request->all());
            $request->session()->flash('msg_success', 'User successfully updated.');
            return redirect('users');
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
