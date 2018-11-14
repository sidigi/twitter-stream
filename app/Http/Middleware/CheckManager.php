<?php

namespace App\Http\Middleware;

use Closure;

class CheckManager
{
    public function handle($request, Closure $next)
    {
        if (! $request->user()->isManager()) {
            return redirect('/');
        }

        return $next($request);
    }
}
