<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class isPetugas
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
        if (!Auth::check() && Auth::guard('petugas')->user()->level == 'petugas') {
            return $next($request);
        }
            return back()->with('Kamuu Bukan petugas');
    }
}
