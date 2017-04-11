<?php

namespace App\Http\Middleware\Yiban;

use Closure;

class recordUrl
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
        session(["requestUrl"=>$request->fullUrl()]);
        return $next($request);
    }
}
