<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ChackYearMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('year')) {
            $yearSession = session('year');
            $year = \config('global.database_year');
            if ($yearSession != $year) {
                DB::disconnect();
                Config::set('database.connections.mysql.database', $yearSession);
                DB::reconnect();
            }
        }
        return $next($request);
    }
}
