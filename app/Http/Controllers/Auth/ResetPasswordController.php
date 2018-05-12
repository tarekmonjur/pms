<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\UserPasswordChanged;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\LoginController as Login;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Site Reset Password Controller
    |--------------------------------------------------------------------------
    |
    | @Description : User Password Reset.
    | @Author : IDDL.
    | @Email : tarekmonjur@gmail.com
    |
    */


    /**
     * User model Instance define.
     */
    protected $user;


    /**
     * LoginController Instance define.
     */
    protected $login;


    /**
     * Create a new controller instance.
     * @param User $user
     * @param LoginController $login
     */
    public function __construct(User $user, Login $login)
    {
        $this->middleware('guest');
        $this->user = $user;
        $this->login = $login;
    }


    /**
     * Show password reset from.
     * @route password/reset(get)
     * @param null $token
     * @param null $email
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function showResetPassword($token=null, $email=null){
        if($token == null){
            return redirect('password/forgot');
        }

        $email = ($email != null)? base64_decode($email) : null;

        return view('auth.passwords.reset',compact('token','email'));
    }


    /**
     * Password reset form validation.
     * @param $request
     */
    public function resetValidation($request){
        $this->validate($request,[
            'email'=>'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password'
        ]);
    }


    /**
     * User password reset.
     * @route password/reset(post)
     * @param Request $request
     * @return $this
     */
    public function resetPassword(Request $request){
        $this->resetValidation($request);

        try{
            $user = $this->user->where('email',$request->email)
                ->where('token',$request->token)->first();

            if(!$user){
                $request->session()->flash('msg_error','Password Not Change.Try Again!');
                return redirect()->back()->withInput();
            }

            $user->password = bcrypt($request->password);
            $user->token = '';
            $user->save();

            Mail::to($user->email)->send(new UserPasswordChanged($user));

            $request->session()->flash('msg_success','Your Password Successfully Change!');
            $request->offsetSet('remember',true);
            return $this->login->login($request);

        }catch(\Exception $e){
            $request->session()->flash('msg_error','Password Not Change.Try Again!');
            return redirect()->back()->withInput();
        }
    }





}
