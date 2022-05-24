<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards): Response|RedirectResponse
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check() && Auth::user()->role_id == RoleEnum::STUDENT) {
                return to_route('');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == RoleEnum::PROFESSOR) {
                return to_route('');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == RoleEnum::DEPARTMENT) {
                return to_route('');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == RoleEnum::CAMPUS) {
                return to_route('');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == RoleEnum::ADMIN) {
                return to_route('admins.backend.home');
            } elseif (Auth::guard($guard)->check() && Auth::user()->role_id == RoleEnum::CHEF_COURSES) {
                return to_route('');
            }
        }

        return $next($request);
    }
}
