<?php

namespace App\Http\Middleware;

use App\Models\AdminModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = AdminModel::where('token', session('token'))->get()->first();

        if (!$user) {
            return redirect('/admin/login')->withErrors(['error', 'Login Terlebihdahulu']);
        }

        if (session('token') == '0') {
            return redirect('/admin/login')->withErrors(['error', 'Login Terlebihdahulu']);
        }
        if (session('token') == null) {
            return redirect('/admin/login')->withErrors(['error', 'Login Terlebihdahulu']);
        }
        return $next($request);
    }
}
