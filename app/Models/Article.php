<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array(
	   'article_id','site_id','article','customer_article','description',
	   'uom','conversion_value','safety_stock','column','rack','row','price');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array(
		'article_id','site_id','article','customer_article','description',
	   'uom','conversion_value','safety_stock','column','rack','row','price');
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
