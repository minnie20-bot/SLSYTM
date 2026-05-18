<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::check()))
            {
                if(Auth::user()->is_admin == 6)
                    {
                        return $next($request);
                    }
                    else
                    {
                        Auth::logout();
                        return redirect(url(''));
                    }
            }
        else
            {
                Auth::logout();
                return redirect(url(''));
            }
    }
}

