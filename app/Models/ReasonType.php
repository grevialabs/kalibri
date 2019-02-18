<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonType extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('reason_type_id','attribute_id','attribute_value','site_id');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('reason_type_id','attribute_id','attribute_value','site_id');
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
