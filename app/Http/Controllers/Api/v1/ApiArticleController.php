<?php

namespace Patriot\Http\Controllers\Api\v1;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Patriot\Http\Controllers\Api\ApiController;
use Patriot\Models\Article;

class ApiArticleController extends ApiController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function get()
	{	
		// Cara panggil method dari parent controller
		// parent::ayamgoreng();
		
		$param = $response = NULL;
		
		if (! empty($_GET)) $param = $_GET;
		
		$response = new Article;
		$response = Article::get($param);
		
		parent::response($response);
	}
	
	public function put()
	{	
		echo "api article put";
		die;
	}
	
	public function post()
	{	
		echo "api article post";
		die;
	}
	
	public function delete()
	{	
		echo "api article delete";
		die;
	}
}
