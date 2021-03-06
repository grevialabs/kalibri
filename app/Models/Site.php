<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('site_id','company_id','site_name','site_address','site_qty_value','flag_qt_value','method_calc','start_date_counting','reset_days','logo_file_name','chamber_sync_flag','field_sync','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('site_id','company_id','company_name','site_name','site_address','site_qty_value','flag_qty_value','method_calc','start_date_counting','reset_days','logo_file_name','status', 'created_at','created_ip','updated_at','updated_by');
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
