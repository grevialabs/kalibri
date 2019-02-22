<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleStock extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('article_stock_id','site_id','article','customer_article','description','stock_qty');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('article_stock_id','site_id','article','customer_article','description','stock_qty');
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
