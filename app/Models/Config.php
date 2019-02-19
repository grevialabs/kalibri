<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('config_id','site_id','config_name','config_value');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('config_id','site_id','config_name','config_value');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array(
		'');
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
