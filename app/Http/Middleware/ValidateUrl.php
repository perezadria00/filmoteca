<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    public function handle(Request $request, Closure $next)
    {
        
        if (!$request->is('filmin/*')) {
            
            return redirect('/')->with('error', 'Invalid URL');
        }

        return $next($request);
    }
}
