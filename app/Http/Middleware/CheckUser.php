<?php

namespace Patriot\Http\Middleware;

use Closure;
use Request;

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
			
			$message = 'Your session has been logout. Please login again. ';
            return redirect($loginurl)->with('message',print_message($message));
        } else {
			// Check role
			
			$list_unavail_menu = $api_url = $api_method = $api_param = $api_header = NULL;
			$api_param['token'] = env('API_KEY');
			$api_param['role_id'] = get_user_cookie('role_id');
			$api_param['list_unavail_menu'] = TRUE;
			$api_param['paging'] = FALSE;

			$api_url = env('API_URL').'role_capability/get_list_detail';
			$api_method = 'get';
			// $api_header['debug'] = 1;
			
			$list_unavail_menu = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
			if (! empty($list_unavail_menu)) {
				$list_unavail_menu = json_decode($list_unavail_menu,1);
				// debug($list_unavail_menu,1);
				if (!empty($list_unavail_menu['data'])) {
					$list_unavail_menu = $list_unavail_menu['data'];
					
					// Check if current page is valid or not
					$uri[1] = Request::segment(1); //
					$uri[2] = Request::segment(2);
					if (isset($_GET['do'])) {
						$urido = $_GET['do'];
					}
					// $uri[3] = Request::segment(3);
					// debug($uri,1);
					// debug($rsu);
					// debug($list_unavail_menu,1);
					if (! empty($list_unavail_menu)) {
						foreach ($list_unavail_menu as $rsu) {
							if ($rsu['capability'] == $uri[2]) {
								echo "you cannot access this page";
								die;
							}		
						}
					}
					
					// Alternatives effiecient logic if data in array
					// if (in_array($uri[2],$list_unavail_menu)) {
						// echo "you cannot access this page";
						// die;
					// }
				}
			}
			// ------------
			
			// $list_unavail_menu = NULL;
			// $url = env('API_URL').'role_capability/get_list_detail?role_id='.$cookie_user['role_id'];
			// // debug($url);
			// $list_unavail_menu = curl_api_liquid($url);
			// // debug($list_unavail_menu);
			// $list_unavail_menu = json_decode($list_unavail_menu,1);
			// $list_unavail_menu = $list_unavail_menu['data'];
			
			// Piggyback data to all Request
			$request->attributes->add(['list_unavail_menu' => $list_unavail_menu]);
			
			// Access data with 
			// \Request::get('list_unavail_menu');
			
		}
        
        return $next($request);
    }
}
