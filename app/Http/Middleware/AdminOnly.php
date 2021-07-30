<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminOnly
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {

        if ( Auth::user() && Auth::user()->isAdmin() ) {
            return $next( $request );
        }

        return redirect( '/' );
    }
}
