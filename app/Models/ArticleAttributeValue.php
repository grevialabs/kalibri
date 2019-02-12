<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleAttributeValue extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('article_attribute_value_id','article_id','article_attribute_id','value');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('article_attribute_value_id','article_id','article_attribute_id','value');
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
