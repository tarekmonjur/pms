<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Site Register Controller
    |--------------------------------------------------------------------------
    | @Description : User Registration
    | @Author : IDDL.
    | @EMAIL : tarekmonjur@gmail.com
    |
    |
    */

    /**
     * User model instance define.
     * @var string
     */
    protected $user;


    /**
     * Where to redirect users after login / registration.
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }


    /**
     * Show User SignUp From
     * @route /user/create(get)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegister(){
        return view('user.create');
    }


    /**
     * Create a new user instance after a valid registration.
     * @route /user/create(post)
     * @param Request $request
     * @return User
     * @internal param array $data
     */
    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:45|min:3|alpha',
            'last_name' => 'required|max:45|min:3|alpha',
            'designation' => 'required|max:45|min:3',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|min:6|max:20',
            'user_type' => 'required',
            'mobile_no' => 'required|max:11|min:11|regex:/\+*[0-9]+$/',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        try{
            if($request->hasFile('image')){
                $photo_name = time().'.'.$request->image->extension();
                $upload_path = public_path('/uploads/users/');
                $request->image->move($upload_path, $photo_name);
                $request->offsetSet('photo', $photo_name);
            }
            User::create($request->all());
            $request->session()->flash('msg_success','User create success.');
        }catch(\Exception $e){
            $request->session()->flash('msg_error','Not Success.Try again.');
        }
        return redirect()->back();
    }





}
