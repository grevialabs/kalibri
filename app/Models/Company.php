<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('company_id','company_name','company_phone','company_address','company_pic');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array(
		'company_id', 'company_name', 'company_phone', 'company_address', 'company_pic');
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
