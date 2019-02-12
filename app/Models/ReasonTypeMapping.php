<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ReasonTypeMapping extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('reason_type_mapping_id','reason_type_id','reason_id');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('reason_type_mapping_id','reason_type_id','reason_id');
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
