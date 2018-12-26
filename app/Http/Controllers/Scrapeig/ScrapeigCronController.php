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

class ScrapeigCronController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function scrapeig_cron()
	{
		// echo "bisa";
		// die;
		
		// $obj = new Username;
// $response = $obj::test();
// debug('gokil<hr/>');
// debug($response,1);
		
		$param = array();
		return view('scrapeig.scrapeig_cron',$param);
		
	}
}
