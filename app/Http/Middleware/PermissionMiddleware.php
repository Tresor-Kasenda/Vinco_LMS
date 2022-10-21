<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return Response|RedirectResponse
     */
    public function handle(
        Request $request,
        Closure $next,
        $role,
        $permission = null,
    ): Response|RedirectResponse {
        if (!$request->user()->hasRole($role)) {
            abort(404);
        }

        if ($permission !== null && !$request->user()->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
