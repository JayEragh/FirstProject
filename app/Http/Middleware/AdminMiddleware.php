<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if (!auth()->check()) {
            return redirect('login');
        }

        // For now, we'll use email-based admin check
        // You can modify this to use a role field in the users table
        $adminEmails = ['admin@docmag.com']; // Add admin emails here
        
        if (!in_array(auth()->user()->email, $adminEmails)) {
            return redirect()->route('home')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}
