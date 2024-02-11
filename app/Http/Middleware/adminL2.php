<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class adminL2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        $level = session()->get("level");
        if ($level != 1 || $level != 2) {
            return redirect('/dashbord');
        } else {
            return $next($request);
        }
    }
}
