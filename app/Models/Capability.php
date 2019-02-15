<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('capability_id','capability');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('capability_id','capability');
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
