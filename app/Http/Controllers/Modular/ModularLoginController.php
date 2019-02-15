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
	
	public function login()
	{
		if (is_member()) {
			$message = 'Welcome again';
			
			$targeturl = 'client/company';
			
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
	
	public function dologin()
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
			
			// $url = 'http://www.grevia.com/api/member';
			$url = env('API_URL').'user/get?user_code='.$post['username'];
			$obj = curl_api_liquid($url);

			if (empty($obj)) {
				// $message = 'Mohon maaf terjadi kesalahan. Silakan coba lagi';
				$message = 'Data anda tidak ditemukan';
				return redirect('login')->with('message', print_message($message));
			}

			$obj = json_decode($obj,1);
			if (isset($obj['is_error'])) {
				$message = 'Mohon maaf, terjadi kesalahan';
				return redirect('login')->with('message', print_message($message));
			}
			
			$decrypt_password = Crypt::decryptString($obj['password']);
			
			// valid
			if (isset($obj['password']) && $post['password'] == $decrypt_password) {
				// check if uri last page exist
				// debug('mantapgam',1);
				
				// create cookie or session 
				$cname = $cvalue = $cminutes = NULL;
				$cname = 'tokenhash';
				// $tokenhash = $obj['member_id'].'||'.$obj['name'].'||'.$obj['email'];
				$cvalue = $obj['user_id'].'||'.$obj['site_id'].'||'.$obj['firstname'].' '.$obj['lastname'].'||'.$obj['email'].'||'.$obj['job_title'].'||';
				$cminutes = 24 * 60;
				Cookie::queue($cname, $cvalue, $cminutes);
				
				// cookie available on next request;
				$message = 'Welcome, '. $obj['firstname'].' '.$obj['lastname'];
				
				// Check user Replenish / Client by user_category
				// if () {
					
				// } else {
					
				// }
				
				$targeturl = 'client/company';
				
				if (isset($_GET['uri'])) $targeturl = urldecode($_GET['uri']);
				
			} else {
				$targeturl = 'login';
				$message = 'Email / Password tidak sesuai';
			}
			return redirect('login')->with('message', print_message($message));
		}
	}
}
