<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'Admin') {
            return $next($request);
        }

        else if (auth()->check() && auth()->user()->role != 'Admin') {
            return redirect('/')->with('error', 'Anda tidak berhak mengakses halaman ini');
        }

        return redirect()->route('login')->with('error', 'Silahkan Login terlebih dahulu.');
    }
}
