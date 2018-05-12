<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\UserForgotPassword;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Forgot Password Controller
    |--------------------------------------------------------------------------
    |
    | @Description : User Forgot Password.
    | @Author : IDDL.
    | @Email : tarekmonjur@gmail.com
    |
    */


    /**
     * The user model instance define.
     */
    protected $user;


    /**
     * Create a new controller instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }


    /**
     * Show forget password send mail form
     * @route password/forgot(get)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showMailSend()
    {
        return view('auth.passwords.email');
    }


    /**
     * Forgot password mail send
     * @route password/sendmail(post)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMail(Request $request){
        $this->validate($request,['email'=>'required|email']);
        $token = str_random(60);

        try{
            $user = $this->user->where('email',$request->email)->first();

            if(!$user){
                $request->session()->flash('msg_error','Sorry, Mail not send!');
                return back()->withInput();
            }

            $user->token = $token;
            $user->save();

            $user->link = '/password/reset/'.$token.'/'.base64_encode($request->email);

            Mail::to($request->email)->send(new UserForgotPassword($user));

            $request->session()->flash('msg_success','Forgot Password Mail Send.');
            return back();
        }catch (\Exception $e){
            $request->session()->flash('msg_error','Sorry, Mail not send!');
            return back()->withInput();
        }
    }





}
