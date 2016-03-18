<?php

namespace App\Http\Middleware;

use Closure;

class GameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (time() > strtotime(powerballNextTime()['time'])) {
            return view('games.middleware');
        }

        return $next($request);
    }
}
