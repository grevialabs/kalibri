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

use Illuminate\Support\Facades\Crypt;

class ModularResetpassController extends ModularController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
	}
	
	public function resetpass_get()
	{
		// debug('azzz',1);
		if ($_GET) 
		{
			$get = NULL;
			$get = $_GET;
			// debug($get,1);
			
			if (! isset($get['token'])) {
				$message = 'Token reset password anda invalid';
				return redirect('login')->with('message', print_message($message));
			}
			
			if (! isset($get['email'])) {
				$message = 'Email anda invalid';
				return redirect('login')->with('message', print_message($message));
			}
			
			// check access group and insert if not exist
			$api_url = $api_method = $api_param = $api_header = NULL;
			$api_url = env('API_URL').'user/get';
			$api_param['email'] = $get['email'];
			$api_method = 'get';
			// $api_header['debug'] = 1;
			$obj = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
			// debug($obj,1);
			if (! empty($obj))
			{
				$obj = json_decode($obj,1);
				if (isset($obj['is_error']))
				{
					$message = 'Mohon maaf, terjadi kesalahan';
					return redirect('login')->with('message', print_message($message));
				}				
				
				if ($get['token'] != $obj['reset_token']) {
					$message = 'Mohon maaf, token reset password anda invalid.';
					return redirect('login')->with('message', print_message($message,'error'));
				}
				
				if (isset($obj['reset_token_expired']) && time() > strtotime($obj['reset_token_expired'])) {
					$message = 'Mohon maaf, token reset password anda sudah tidak berlaku.';
					return redirect('login')->with('message', print_message($message));
				}
				
				// Success
				// $url_reset = 'http://devklbox.kawanlama.com/resetpass?token='.$reset_token.'&email='.$obj['email'];
				// $content = '';
				// $content .= "Dear " . $obj['fullname'] . "," . BR;
				// $content .= "Anda mendapatkan email ini karena ada permintaan mereset password atas akun anda di www.klbox.kawanlama.com.".BR;
				// $content .= "Klik <a href=' " . $url_reset . " '>link</a> ini atau copy paste url " . $url_reset . " ini ke browser anda, untuk mereset password atau abaikan email ini jika anda tidak merasa melakukan permintaan ini.";
				// $content .= "" . BR.BR;
				// $content .= "Salam".BR;
				// $content .= "Admin KLbox";
				// debug($content,1);
				
				// send email here to SMTP
				
				// $message = 'Email Reset Password telah dikirim ke email anda di ' . $post['email'];
				// return redirect('login')->with('message', print_message($message));
				
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
		// $param['PAGE_TITLE'] = Lang::get('modular/resetpass.page_title');
		// $param['CONTENT'] = view('modular.resetpass',$param);
		return view('template.' . $this->themes . '.resetpass',$param);
	}
	
	public function resetpass_post()
	{
		// debug('yamete',1);
		if ($_POST) 
		{
			$post = NULL;
			$post = $_POST;
			// debug($get,1);
			
			if (! isset($post['token'])) {
				$message = 'Token reset password anda invalid';
				return redirect('login')->with('message', print_message($message));
			}
			
			if (! isset($post['email'])) {
				$message = 'Email anda invalid';
				return redirect('login')->with('message', print_message($message));
			}
			
			// check access group and insert if not exist
			$api_url = $api_method = $api_param = $api_header = NULL;
			$api_url = env('API_URL').'user/post';
			$api_param['email'] = $post['email'];
			$api_method = 'get';
			// $api_header['debug'] = 1;
			$obj = curl_api_liquid($api_url, $api_method, $api_header, $api_param);
			
			
			if (! empty($obj))
			{
				$obj = json_decode($obj,1);
				if (isset($obj['is_error']))
				{
					$message = 'Mohon maaf, terjadi kesalahan';
					return redirect('login')->with('message', print_message($message,'error'));
				}				
				
				if ($post['token'] != $obj['reset_token']) {
					$message = 'Mohon maaf, token reset password anda invalid.';
					return redirect('login')->with('message', print_message($message,'error'));
				}
				
				if (isset($obj['reset_token_expired']) && time() > strtotime($obj['reset_token_expired'])) {
					$message = 'Mohon maaf, token reset password anda sudah tidak berlaku.';
					return redirect('login')->with('message', print_message($message,'error'));
				}
				
				// Update here
				if ($post['new_password'] == $post['confirm_new_password']) {
					
					// Update API here
					$api_url = $api_method = $api_param = $api_header = NULL;
					$api_url = env('API_URL').'user';
					$api_param['user_id'] = $obj['user_id'];
					$api_param['reset_token_expired'] = get_datetime();
					$api_param['password'] = Crypt::encryptString($post['new_password']);
					$api_method = 'put';
					// $api_header['debug'] = 1;
					$update_user = curl_api_liquid($api_url, $api_method, $api_header, $api_param);	
					$update_user = json_decode($update_user,1);
					
					if ($update_user) {
						$message = 'Password atas email ' . $post['email'] . ' telah berhasil dirubah. Silakan login kembali dengan password baru';
						return redirect('login')->with('message', print_message($message));
					} else {
						$message = 'Password atas email ' . $post['email'] . ' telah gagal dirubah. Mohon ulangi aksi kembali';
						return redirect(current_full_url())->with('message', print_message($message));
					}
					
					
				} else {
					$message = 'Terjadi kesalahan, password baru dan konfirmasi password harus sama.';
					return redirect(current_full_url())->with('message', print_message($message,'error'));
				}
				
				// send email here to SMTP
				
				// $message = 'Email Reset Password telah dikirim ke email anda di ' . $post['email'];
				// return redirect('login')->with('message', print_message($message));
				
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
		return view('template.' . $this->themes . '.resetpass',$param);
	}
}
