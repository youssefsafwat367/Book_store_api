<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user() != NULL) {
            if (auth()->user()->role == 'user') {
                return $next($request);
            }else {
                return back();
            }
        }else{
            return redirect()->route('login') ;
        }
    }
}