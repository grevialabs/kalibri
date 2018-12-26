<?php

namespace Patriot\Http\Controllers\Member;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;

use Cookie;
use Patriot\Http\Controllers\Controller;

class MemberController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	// Harus create middleware
	// public function __construct(Request $request, Redirector $redirect)
	public function __construct()
	{
		// $url = base_url().'berak';
		// $url = 'member/ayam';
		// $url = 'login';
		// debug('bangkesasi',1);
		// return redirect($url);
		// $redirect->to($url)->send();
		// die;
		
		// Redirect guest to login
		// if (! is_member()) {
			// $url = base_url().'login';
			// return redirect($url);
			// debug('invalid member<hr/>');
		// }
		// else {
			// debug('valid member<hr/>');
		// }
		// die;
	}
	
	public function home()
	{
		// echo "masukga sih";die;
		$param = NULL;
		$param['PAGE_TITLE'] = 'Member home';
		$param['BS_TEMPLATE'] = TRUE;
		$param['CONTENT'] = view('member.home',$param);
		// $param['CONTENT'] = view('modular.login',$param);
		return view('template.general.index',$param);
	}
	
	// public function about()
	// {
		// $param = NULL;
		// $param['PAGE_TITLE'] = 'Halaman Login';
		// $param['CONTENT'] = view('modular.login',$param);
		// return view('template.general.index',$param);
	// }
	
	public function logout()
	{
		// clear cookie
		// $cookie = Cookie::forget('tokenhash');

		$cookie = Cookie::queue(Cookie::forget('tokenhash'));
		return redirect('/');
	}
}
