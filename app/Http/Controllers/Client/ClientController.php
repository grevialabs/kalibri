<?php

namespace Patriot\Http\Controllers\Client;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;

use Patriot\Http\Controllers\Modular\ModularController;

use Cookie;
use Lang;
use Request;

class ClientController extends Controller
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
	{
		$this->themes = env('THEMES','general');
		// $this->themes = env('THEMES','general');
		
		// debug('gebleg',1);
		// if (is_member()) {
		if (! is_member()) {
			$message = 'Please login first';
			return redirect(base_url().'login')->with('message', print_message($message));
		}
		
	}
	
	public function index()
	{
		// echo "Client index";
		return redirect('client/company');
	}
	
	public function login()
	{
		// return view('template.' . $this->themes . '.login');
		// or
		
		$encrypted = Crypt::encryptString('Hello world.');
		
		debug($encrypted);
		debug(HR);
		
		$decrypt = Crypt::decryptString($encrypted);
		debug($decrypt,1);
		
		return view('client.login');
	}
	
	public function example()
	{
		$param = $content = $get = $lang = $companylang = NULL;
		
		if ($_GET) $get = $_GET;
		
		$lang = Lang::get('common');
		$companylang = Lang::get('modular/company');
		// debug($companylang,1);
		
		$param['get'] = $get;
		$param['lang'] = $lang;
		$param['companylang'] = $companylang;
		$param['PAGE_HEADER'] = 'Halaman ' . $companylang['module'];
		$param['PAGE_TITLE'] = 'Halaman ' . $companylang['module'];
				
		$content = view('client.example',$param);
		$themes = env('THEMES','general');
		$param['CONTENT'] = $content;
		return view('template.' . $themes . '.index',$param);
		die;
	}
	
	public function logout()
	{
		Cookie::queue('tokenhash', NULL, 1000);
		// Cookie::queue(Cookie::forget('tokenhash'));
		// unset($_COOKIE);
		// unset($_SESSION);
		// debug($_COOKIE,1);
		
		// clear all cookies and session
		$message = 'Your account has been logout';
		return redirect(base_url().'login')->with('message', print_message($message));
	}
}
