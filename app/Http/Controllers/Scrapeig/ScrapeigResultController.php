<?php

namespace Patriot\Http\Controllers\Scrapeig;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Controller;
use Patriot\Http\Controllers\ModularController;

use Patriot\Models\Scrapeig;
// use Patriot\Models\Scrape\Scrape;
use Patriot\Models\Scrapeig\Username;

use Cookie;

class ScrapeigResultController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function scrapeig_result()
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
		// return view('scrapeig.scrape_result',$data);
		
		$param = NULL;
		$param['PAGE_TITLE'] = 'Halaman Scrape IG';
		$param['BS_TEMPLATE'] = TRUE;
		
		$param['data'] = $data;
		
		$param['CONTENT'] = view('scrapeig.scrapeig_result',$param);
		return view('template.scrapetw.index',$param);
		
	}
}
