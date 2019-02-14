<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('role_id','role_name');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('role_id','role_name');
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
