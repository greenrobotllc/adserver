<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Controllers\TimeZoneController;

class TimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $asi = new TimeZoneController;
        $timezone = $asi->show();
        date_default_timezone_set($timezone);
        \Config::set('app.timezone', $timezone);
        return $next($request);
    }
}
