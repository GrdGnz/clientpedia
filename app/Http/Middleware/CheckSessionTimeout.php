<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSessionTimeout
{
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            // User is not authenticated; redirect to login
            return redirect('/');
        }

        return $next($request);
    }
}
