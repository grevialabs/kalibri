<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleStock extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('site_id','article_id','customer_article','description','stock_qty');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('site_id','article_id','customer_article','description','stock_qty');
       return $str;
    }
	
	// public function validate_action($post,)
	// {
		// if (!)
			
		// $str = NULL;
		// foreach ($post as $key => $val) 
		// {
			
		// }
		
		// return $str;
	// }
	
}
