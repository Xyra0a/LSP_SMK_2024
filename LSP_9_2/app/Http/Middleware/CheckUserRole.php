<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRole = session('role');
        if (!in_array($userRole, $roles))
        {
           return abort(403, 'Gada izin');
        } else {
            return $next($request);
        }
    }
}
