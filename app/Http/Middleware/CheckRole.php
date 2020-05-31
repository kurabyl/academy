<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if(!in_array(Auth::user()->role ,$roles))
        {
            return redirect('/');
        }
        return $next($request);
    }

    private function roles($roles)
    {
        switch ($roles) {
            case 'admin':
                return true;
            break;
            case 'manager':
                return true;
            break;
        }
        return false;
    }
}
