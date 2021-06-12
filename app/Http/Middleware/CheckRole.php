<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if ($role == 'admin' && $user->getRole->name != 'admin') {
            abort(403);
        }
        if ($role == 'client' && $user->getRole->name != 'client') {
            abort(403);
        }
        if ($role == 'manager' && $user->getRole->name != 'manager') {
            abort(403);
        }
        return $next($request);
    }
}
