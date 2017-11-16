<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
     /*
     |--------------------------------------------------------------------------
     | Dashboard Controller
     |--------------------------------------------------------------------------
     |
     | @Description : Application Dashboard
     | @Author : IDDL.
     | @Email  : tarekmonjur@gmail.com
     |
     */

    /**
     * DashboardController constructor.
     */
    public function __construct(){
         $this->middleware('auth');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('dashboard');
    }


}
