<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyModuleAccessGuard
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $module
     * @param $access
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $module, $access)
    {
        if (!Auth::user()->hasModuleAccess($module, $access)){
            return redirect(route('unauthorized-access'));
        }
        return $next($request);
    }
}
