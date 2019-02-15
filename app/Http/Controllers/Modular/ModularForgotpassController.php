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
		
		if ($_POST) 
		{
			$post = NULL;
			$post = $_POST;
			
			if (! isset($post['email'])) {
				$message = 'Email harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			if (! isset($post['password'])) {
				$message = 'Password harus diisi';
				return redirect('login')->with('message', print_message($message));
			}
			
			// $url = 'http://www.grevia.com/api/member';
			$url = env('API_URL').'member/get?email='.$post['email'];
			
			$obj = curl_api_grevia($url);
			// debug($obj,1);

			if (! empty($obj))
			{
				$obj = json_decode($obj,1);
				if (isset($obj['is_error']))
				{
					$message = 'Mohon maaf, terjadi kesalahan';
					return redirect('login')->with('message', print_message($message));
				}
				
				// debug('nyoh '.dodecrypt($obj['password']). ' '.$post['password']);
				// debug($obj,1);
				// valid
				if (isset($obj['password']) && dodecrypt($obj['password']) == $post['password'])
				{
					// check if uri last page exist
					
					
					// create cookie or session 
					$cname = $cvalue = $cminutes = NULL;
					$cname = 'tokenhash';
					// $tokenhash = $obj['member_id'].'||'.$obj['name'].'||'.$obj['email'];
					$cvalue = $obj['member_id'].'||'.$obj['name'].'||'.$obj['email'];
					$cminutes = 24 * 60;
					Cookie::queue($cname, $cvalue, $cminutes);
					
					// cookie available on next request;
					
					// redirect to member 
					return redirect('member/home');
					
				}
				else 
				{
					$message = 'Email / Password tidak sesuai';
					return redirect('login')->with('message', print_message($message));
				}
			}
			else 
			{
				// $message = 'Mohon maaf terjadi kesalahan. Silakan coba lagi';
				$message = 'Data anda tidak ditemukan';
				return redirect('login')->with('message', print_message($message));
			}
		}
		
		$param = NULL;
		$param['message'] = Lang::get('common.message');
		$param['PAGE_TITLE'] = Lang::get('modular/forgotpass.page_title');
		$param['CONTENT'] = view('modular.forgotpass',$param);
		return view('template.general.index',$param);
	}
}
