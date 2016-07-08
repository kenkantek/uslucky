<?php

namespace App\Http\Middleware;

use Closure;

class ComingSoonMiddleware
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
        if (env('GAME_DEBUG')) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Coming Soon.', 500);
            } else {
                return view('pages.comingsoon');
            }
        }

        return $next($request);
    }
}
