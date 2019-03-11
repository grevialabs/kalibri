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
			
			// debug($post,1);
			
			if (! isset($post['username'])) {
				$message = 'Email harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			if (! isset($post['password'])) {
				$message = 'Password harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			// Action start here
			$param = $api_header = NULL;
			$param['user_code'] = $post['username'];
			$api_url = env('API_URL').'user/get';
			$api_method = 'get';
			// $api_header['debug'] = 1;
			$obj = curl_api_liquid($api_url, $api_method, $api_header, $param);

			if (empty($obj)) {
				// $message = 'Mohon maaf terjadi kesalahan. Silakan coba lagi';
				$message = 'Data anda tidak ditemukan';
				return redirect('login')->with('message', print_message($message));
			}

			$obj = json_decode($obj,1);
			if (isset($obj['is_error'])) {
				$message = 'Mohon maaf, terjadi kesalahan. Silakan ulangi.';
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
				$message = 'Mohon maaf, user anda sedang terkunci. Silakan hubungi administrator';
				return redirect('login')->with('message', print_message($message,'error'));
			}
			
			// not a validation suppose tobe
			// if (isset($obj['locked_time']) && time() < strtotime($obj['locked_time'])) {
				// $message = 'Mohon maaf, user anda sedang terkunci. Silakan hubungi administrator';
				// return redirect('login')->with('message', print_message($message,'error'));
			// }
			
			// valid
			if (isset($obj['password']) && $post['password'] == $decrypt_password) {
				
				// --------------------------
				// check access group and insert if not exist
				$api_url = $api_method = $api_param = $api_header = NULL;
				$api_url = env('API_URL').'role_capability/cron_insert_role';
				$api_param['role_id'] = get_user_cookie('role_id');
				$api_method = 'get';
				// $api_header['debug'] = 1;
				$list_role = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
				// --------------------------
				
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
				
			} else {
				
				// Add +1 error
				
				$targeturl = 'login';
				$message = 'Email / Password tidak sesuai';
			}
			return redirect($targeturl)->with('message', print_message($message));
		}
	}
}
