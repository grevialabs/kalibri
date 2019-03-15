<?php

namespace Patriot\Http\Controllers\Modular;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\Modular\ModularController;

use Cookie;
use Lang;

class ModularForgotpassController extends ModularController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
	}
	
	public function forgotpass()
	{
		// Redirect guest to login
		// if (is_member()) {
		// 	$url = base_url().'member/home';
		// 	// return redirect($url);
		// 	debug('valid member<hr/>');
		// } else 
		// {
		// 	debug('invalid member<hr/>');
		// }
		// debug($_POST,1);
		if ($_POST) 
		{
			$post = NULL;
			$post = $_POST;
			// debug($post,1);
			
			if (! $post['email']) {
				$message = 'Email reset password harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			// check access group and insert if not exist
			$api_url = $api_method = $api_param = $api_header = NULL;
			$api_url = env('API_URL').'user/get';
			$api_param['email'] = $post['email'];
			$api_method = 'get';
			// $api_header['debug'] = 1;
			$obj = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
			
			if (! empty($obj))
			{
				$obj = json_decode($obj,1);
				if (isset($obj['is_error'])) {
					$message = 'Mohon maaf, terjadi kesalahan';
					return redirect('login')->with('message', print_message($message,'error'));
				}

				// debug($obj,1);
				if (! isset($obj['user_id'])) {
					$message = 'Email ' . $post['email'] . ' tidak terdaftar';
					return redirect('login')->with('message', print_message($message,'error'));
				}				
				
				// debug($obj,1);
				
				$reset_token = $reset_token_expired = NULL;
				$reset_token = generateRandomString(10);
				$reset_token_expired = date('Y-m-d H:i:s',time()+86400); // add 1 day
				
				// update data user here
				$api_url = $api_method = $api_param = $api_header = NULL;
				$api_url = env('API_URL').'user';
				$api_param['user_id'] = $obj['user_id'];
				$api_param['reset_token'] = $reset_token;
				$api_param['reset_token_expired'] = $reset_token_expired;
				$api_method = 'put';
				// $api_header['debug'] = 1;
				$update_user = curl_api_liquid($api_url, $api_method, $api_header, $api_param);	
				
				$reset_token_expired = date('d M Y H:i',strtotime($reset_token_expired));
				
				// Success
				$url_reset = 'http://devklbox.kawanlama.com/resetpass?token='.$reset_token.'&email='.$obj['email'];
				$content = '';
				$content .= "Dear " . $obj['fullname'] . "," . BR;
				$content .= "Anda mendapatkan email ini karena ada permintaan mereset password atas akun anda di www.klbox.kawanlama.com.".BR;
				$content .= "Klik <a href=' " . $url_reset . " '>link</a> ini atau copy paste url " . $url_reset . " ini ke browser anda dalam kurun waktu 1 x 24jam atau sebelum " . $reset_token_expired . ", untuk mereset password atau abaikan email ini jika anda tidak merasa melakukan permintaan ini.";
				$content .= "" . BR.BR;
				$content .= "Salam".BR;
				$content .= "Admin KLbox";
				// debug($content,1);
				
				// send email here to SMTP
				
				$message = 'Email Reset Password telah dikirim ke email anda di ' . $post['email'].BR.BR.$content;
				return redirect('login')->with('message', print_message($message));
				
			}
			else 
			{
				// $message = 'Mohon maaf terjadi kesalahan. Silakan coba lagi';
				$message = 'Data email anda tidak ditemukan.';
				return redirect('login')->with('message', print_message($message));
			}
		}
		
		$param = NULL;
		$param['message'] = Lang::get('common.message');
		$param['PAGE_TITLE'] = Lang::get('modular/forgotpass.page_title');
		$param['CONTENT'] = view('modular.forgotpass',$param);
		return view('template.' . $this->themes . '.index',$param);
	}
}
