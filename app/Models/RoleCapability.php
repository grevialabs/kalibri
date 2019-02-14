<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class RoleCapability extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('role_capability_id','role_id','capability_id');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('role_capability_id','role_id','capability_id');
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
