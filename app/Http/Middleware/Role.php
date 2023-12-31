<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if(auth()->user()->role == 'SuperAdmin' || auth()->user()->role == 'Sales' || auth()->user()->role == 'Purchase' || auth()->user()->role == 'Manager') {
        //     return $next($request);
        // }
        // return redirect(`home`)->with(`eror`,"Kamu Tidak Memiliki Akses");
        if(in_array($request->user()->role, $roles)){
            return $next($request);
        }
        return redirect('/login');

    }
}
