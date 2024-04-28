<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                switch ($user->usertype) {
                    case 'doctor':
                        return redirect('/doctor/home');
                        break;
                    case 'nurse':
                        return redirect('/nurse/home');
                        break;
                    case 'patient':
                        return redirect('/patient/dashboard');
                        break;
                }

                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
