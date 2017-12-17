<?php

namespace App\Http\Middleware;

use Closure;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $url = \Request::segment(1);
        $method = \Request::method();

        if($url2 =\Request::segment(2))
        {
            if($url3 = \Request::segment(3))
            {
                if($url4 = \Request::segment(4))
                {
                    if($url5 = \Request::segment(5))
                    {
                        if($url6 = \Request::segment(6))
                        {
                            if($url7 = \Request::segment(7)){
                                $url = $url5.'/'.$url7;
                            }else if(strtolower($method) == "delete"){
                                $url = $url5.'/delete';
                            }else if(strtolower($method) == "put"){
                                $url = $url5.'/edit';
                            }else if($url6 == 'create'){
                                $url = $url5.'/create';
                            }else{
                                $url = $url3.'/'.$url5;
                            }
                        }else if(strtolower($method) == "post"){
                            $url = $url5.'/create';
                        }else{
                            $url = $url3.'/'.$url5;
                        }
                    }else if(strtolower($method) == "delete"){
                        $url = $url3.'/delete';
                    }else if(strtolower($method) == "put"){
                        $url =  $url3.'/edit';
                    }else if($url4 == 'create'){
                        $url = $url3.'/create';
                    }else{
                        $url = $url.'/'.$url3;
                    }
                }else if(strtolower($method) == "delete"){
                    $url .= '/delete';
                }else if(strtolower($method) == "put"){
                    $url .= '/edit';
                }else{
                    $url .= '/'.$url3;
                }
            }else if(strtolower($method) == "delete"){
                $url .= '/delete';
            }else if(strtolower($method) == "put"){
                $url .= '/edit';
            }else if($url2 == 'create'){
                $url = $url.'/create';
            }
        }

        if(!canAccess($url)){
            return response()->view('errors.500');
        }
        return $next($request);
    }
}
