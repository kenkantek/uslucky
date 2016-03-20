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

        // $d = explode('/', powerballNextTime()['time']);
        // (count($d) !== 3) && abort(500, 'Something bad happened');
        // $draw_at = Carbon::create($d[2], $d[0], $d[1], env('HOURS_BEFORE_CLOSE'));
        // if (Carbon::now() > $draw_at) {
        //     return view('games.middleware');
        // }

        return $next($request);
    }
}
