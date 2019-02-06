<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('level_id','level_hierarchy','level_name','chamber_sync_flag','field_sync','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('level_id','level_hierarchy','level_name','chamber_sync_flag','field_sync','status', 'created_at','created_ip','updated_at','updated_by','updated_ip');
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
