<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Factory as Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | @Description : User Login.
    | @Author : IDDL.
    | @Email : tarekmonjur@gmail.com
    |
    */


    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = '/';


    /**
     *  Auth Instance define.
     * @var
     */
    protected $auth;


    /**
     * LoginController constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
    }


    /**
     * Show login form
     * @route /login(get)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin(){
        return view('auth.login');
    }


    /**
     * The login form validation
     * @param $request
     */
    public function loginValidation($request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
    }


    /**
     * The login
     * @route /login(post)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request){
        $this->loginValidation($request);

        if($this->auth->attempt([
            'email'     => $request->email,
            'password'  => $request->password,
        ],$request->remember)){
            return redirect()->intended('/');
        }else{
            $request->session()->flash('msg_error','Email/Password is invalid!');
            return redirect()->back()->withInput();
        }
    }


    /**
     * The user logout
     * @route /logout(post)
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){
        $this->auth->logout();
        return redirect('/');
    }








}
