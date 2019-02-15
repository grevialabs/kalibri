<?php

namespace Patriot\Http\Middleware;

use Closure;

class CheckUser
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
			$loginurl = 'login';
			
			// Redirect to last page
            // $uri = NULL;
			// debug($uri,1);
            // if (isset($_GET['uri'])) $url = '?uri='.$_GET['uri'];
			$loginurl .= '?uri='.urlencode(current_full_url());
			
			$message = 'Please login bro';
            return redirect($loginurl)->with('message',print_message($message));
        }
        
        return $next($request);
    }
}
