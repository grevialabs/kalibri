<?php

namespace Patriot\Http\Middleware;

use Closure;

class CheckMember
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
        // debug('jalan checkmember<hr/>',1);
        
        // if ($request->is_not_member) {
        //     return redirect('login');
        // }

        if (! is_member()) {
            return redirect('login');
        }
        
        return $next($request);
    }
}
