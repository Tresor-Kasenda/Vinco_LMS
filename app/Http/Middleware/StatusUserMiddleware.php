<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (auth()->check() && (\Auth::user()->status == 0)) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('danger', 'Vous avez ete bani sur la plateforme');
        }

        return $next($request);
    }
}
