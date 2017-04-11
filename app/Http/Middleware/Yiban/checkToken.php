<?php

namespace App\Http\Middleware\Yiban;

use App\Http\Controllers\Yiban\OauthController;
use Closure;

class checkToken
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
        if((new OauthController($request))->token_info()){
            return $next($request);
        }else{
            return redirect()->route('yiban_oauth');
        }
    }
}
