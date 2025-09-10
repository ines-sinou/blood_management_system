<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roleName)
    {
        $user = Auth::user();

        // Check if user has the correct role
        if ($user && $user->role && $user->role->name === $roleName) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
