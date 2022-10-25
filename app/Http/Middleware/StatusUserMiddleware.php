<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StatusUserMiddleware
{
    public function handle(Request $request, Closure $next)
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
