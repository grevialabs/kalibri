<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('user_role_id','role_id','user_id');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
        static $str = array('user_role_id','role_id','user_id');
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
