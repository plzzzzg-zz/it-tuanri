<?php

namespace App\Http\Middleware\Yiban;

use Closure;

class checkAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session("expires") > time()){
            return $next($request);
        }else{
            return redirect()->route('yiban_oauth');
        }
    }
}
