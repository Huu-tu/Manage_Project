<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CusTomAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('key')){
            return redirect('/login');
        }
        return $next($request);
    }
}
