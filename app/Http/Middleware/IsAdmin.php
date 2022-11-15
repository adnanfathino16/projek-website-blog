<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        // jika dia tamu atau belum login tampilkan hal forbidden dengan kode 403
        // jika dia adminnya maka boleh tampilkan jika bukan tampilkan forbidden

        // bisa juga memakai (!auth()->check) ||
        if(auth()->guest() || !auth()->user()->is_admin){
            abort(403);
        }
        return $next($request);
    }
}
