<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;




// Currently not using this middleware
// Currently not using this middleware
// Currently not using this middleware
// Currently not using this middleware
// Currently not using this middleware



class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->session()->has('username')){
            return redirect()->route("login")->with("You must logged in.");
        }
        return $next($request);
    }
}
