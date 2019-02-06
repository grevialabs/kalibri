<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('reason_id','reason_value','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('reason_id','reason_value','status', 'created_at','created_ip','updated_at','updated_by');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array(
		'user_id', 'company_name', 'company_phone', 'company_address', 'company_pic');
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
