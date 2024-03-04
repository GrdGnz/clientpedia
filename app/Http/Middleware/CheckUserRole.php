<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the authenticated user has the specified role
        if ($request->user()->role_id != $role) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
