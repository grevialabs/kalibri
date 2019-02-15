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

class ScrapetwCronController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function scrapetw_cron()
	{
		// echo "bisa";
		// die;
		
		// $obj = new Username;
// $response = $obj::test();
// debug('gokil<hr/>');
// debug($response,1);
		
		$param = array();
		return view('scrapetw.scrapetw_cron',$param);
		
	}
}
