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

class ScrapetwController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function scrapetw_export()
	{
		$q = "
		SELECT * 
		FROM scr_username u 
		ORDER BY u.username_id DESC
		LIMIT 5
		";
		$data = orm_get_list($q);
		debug($data);
		die;
		
		// $obj = new Username;
		// $response = $obj::test();
		// debug('gokil<hr/>');
		// debug($response,1);
		
		// $param = array();
		// return view('scrapetw.scrape_result',$param);
		
	}
	
	// public function scrapeig_data()
	// {
		
		// return view('scrapeig.scrape_result',$param);
	// }
}
