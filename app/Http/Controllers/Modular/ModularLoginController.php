<?php

namespace Patriot\Http\Controllers\Modular;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Crypt;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\Modular\ModularController;

use Cookie;
use Lang;

class ModularLoginController extends ModularController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
	}
	
	// public function login()
	public function login_get()
	{
		if (is_member()) {
			$message = 'Welcome again';
			
			$targeturl = 'client/dashboard';
			
			if (isset($_GET['uri'])) $targeturl = urldecode($_GET['uri']);
			
			return redirect($targeturl)->with('message', print_message($message));
		}
		
		// Redirect guest to login
		
		
		// $param = $content = $get = $lang = $loginlang = $current_url = NULL;
		
		// $lang = Lang::get('common');
		$loginlang = Lang::get('modular/login');	
		
		// $param['get'] = $get;
		// $param['lang'] = $lang;
		// $param['loginlang'] = $loginlang;
		// $param['PAGE_TITLE'] = $loginlang['module'];
		// $param['MODULE'] = $loginlang['module'];
		
		$param['PAGE_HEADER'] = $loginlang['module'];
		return view('template.' . $this->themes . '.login',$param);
		
		// $param = NULL;
		// $param['message'] = Lang::get('common.message');
		// $param['PAGE_TITLE'] = Lang::get('modular/login.page_title');
		// $param['CONTENT'] = view('modular.login',$param);
		// return view('template.' . $this->themes . '.index',$param);
	}
	
	// public function dologin()
	public function login_post()
	{
		if ($_POST) 
		{
			$post = $message = NULL;
			$post = $_POST;
			
			$targeturl = 'login';
			
			// debug($post,1);
			
			if (! isset($post['username'])) {
				$message = 'Email must be filled';
				return redirect('login')->with('message', print_message($message));
			}
			
			if (! isset($post['password'])) {
				$message = 'Password must be filled';
				return redirect('login')->with('message', print_message($message));
			}
			
			// Action start here
			$param = $api_header = NULL;
			$param['user_code'] = $post['username'];
			$api_url = env('API_URL').'user';
			$api_method = 'get';
			// $api_header['debug'] = 1;
			$obj = curl_api_liquid($api_url, $api_method, $api_header, $param);
			$obj = json_decode($obj,1);
			
			if (empty($obj) || ! isset($obj['user_id'])) {
				
				// $message = 'Mohon maaf terjadi kesalahan. Silakan coba lagi';
				$message = 'Your username is not found. Please register.';
				return redirect('login')->with('message', print_message($message));
			}

			if (isset($obj['is_error'])) {
				$message = 'Sorry error occured. Please try again';
				return redirect('login')->with('message', print_message($message,'error'));
			}
			
			$decrypt_password = NULL;
			if (isset($obj['password'])) $decrypt_password = Crypt::decryptString($obj['password']);
			
			// Check if banned or not
			// if ($obj['counter_wrong_pass'] > 3) {
				// $message = 'Mohon maaf, terjadi kesalahan';
				// return redirect('login')->with('message', print_message($message,'error'));
			// }
			
			// Check if banned or not
			if ($obj['status_lock']) {
				$message = 'Sorry your username has been locked since ' . date('d M Y, H:i',strtotime($obj['locked_time'])). '. Please reset password to continue login';
				return redirect('login')->with('message', print_message($message,'error'));
			}

			if (isset($obj['password']) && $post['password'] != $decrypt_password) {
				// Add +1 error
				
				$obj['counter_wrong_pass'] += 1;
				
				// Action start here
				$api_param = $api_header = NULL;
				$api_param['user_id'] = $obj['user_id'];
				$api_param['counter_wrong_pass'] = $obj['counter_wrong_pass'];
				
				if ($obj['counter_wrong_pass'] >= 3) {
					$api_param['status_lock'] = 1;
					$api_param['locked_time'] = get_datetime();
				}
				
				$api_url = env('API_URL').'user';
				$api_method = 'put';
				$update = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
				
				$targeturl = 'login';
				$message = 'Email / Password not match. '. $obj['counter_wrong_pass'] . ' of max 3 times';
				
				if ($obj['counter_wrong_pass'] >= 3) {
					$message = 'Your username has been locked due to 3 times wrong password. Please reset password to continue login';
					
				}
				return redirect($targeturl)->with('message', print_message($message,'error'));
			}
			
			// valid
			// debug($post['password'] . ' == ' . $decrypt_password,1);
			if (isset($obj['password']) && $post['password'] == $decrypt_password) 
			{
				// debug('benernih',1);
				// --------------------------
				// check access group and insert if not exist
				$api_url = $api_method = $api_param = $api_header = NULL;
				$api_url = env('API_URL').'role_capability/cron_insert_role';
				$api_param['role_id'] = get_user_cookie('role_id');
				$api_method = 'get';
				// $api_header['debug'] = 1;
				$list_role = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
				
				// check user if need update counter_wrong_pass
				if ($obj['counter_wrong_pass'] > 0) {
					
					$api_url = $api_method = $api_param = $api_header = NULL;
					$api_url = env('API_URL').'user';
					$api_param['user_id'] = get_user_cookie('user_id');
					$api_param['counter_wrong_pass'] = 0;
					$api_method = 'put';
					// $api_header['debug'] = 1;
					$update = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
				}

				// create cookie or session 
				$cname = $cvalue = $cminutes = NULL;
				$cname = 'tokenhash';
				// $tokenhash = $obj['member_id'].'||'.$obj['name'].'||'.$obj['email'];
				$cvalue = $obj['user_id'].'||'.$obj['site_id'].'||'.$obj['fullname'].'||'.$obj['email'].'||'.$obj['job_title'].'||'.$obj['user_code'].'||'.$obj['role_id'].'||'.$obj['role_name'];
				$cminutes = 24 * 60;
				Cookie::queue($cname, $cvalue, $cminutes);
				
				// cookie available on next request;
				$message = 'Welcome, '. $obj['firstname'].' '.$obj['lastname'];
				
				// Check user Replenish / Client by user_category
				// if () {
					
				// } else {
					
				// }
				
				$targeturl = 'client/dashboard';
				
				// check if uri last page exist
				if (isset($_GET['uri'])) $targeturl = urldecode($_GET['uri']);
				
				return redirect($targeturl)->with('message', print_message($message));
			}
		}
	}
}
