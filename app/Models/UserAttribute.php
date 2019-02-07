<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttribute extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('user_id','attribute','value');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('user_id','attribute','value');
       return $str;
    }
	
	// public function validate_action($post,)
	// {
		// if (!)
			
		// $str = NULL;
		// foreach ($post as $key => $value) 
		// {
			
		// }
		
		// return $str;
	// }
	
}
