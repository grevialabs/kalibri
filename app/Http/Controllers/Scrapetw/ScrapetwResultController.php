<?php

namespace Patriot\Http\Controllers\Scrapetw;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\ModularController;

use Patriot\Models\Scrapetw;
// use Patriot\Models\Scrape\Scrape;
use Patriot\Models\Scrapetw\Username;

use Cookie;

class ScrapetwResultController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function scrapetw_result()
	{
		$q = "SELECT * FROM scr_username u ORDER BY u.username_id DESC";
		$data = orm_get_list($q);
		// debug($data);
		// die;
		
		// $obj = new Username;
		// $response = $obj::test();
		// debug('gokil<hr/>');
		// debug($response,1);
		
		// $param = array();
		// $param['data'] = $data;
		// return view('scrapetw.scrape_result',$data);
		
		$param = NULL;
		$param['PAGE_TITLE'] = 'Halaman Scrape Twitter';
		$param['BS_TEMPLATE'] = TRUE;
		
		$param['data'] = $data;
		
		$param['CONTENT'] = view('scrapetw.scrapetw_result',$param);
		return view('template.scrapetw.index',$param);
		
	}
}
