<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('user_id','site_id','parent_user_id','level_id','user_code','firstname','lastname','quota_initial','quota_additional','quota_remaining', 'job_title', 'division','email','user_category','password','counter_wrong_pass','status_lock','locked_time','reset_by','reset_time','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('user_id','site_id','parent_user_id','level_id','user_code','firstname','lastname','quota_initial','quota_additional','quota_remaining', 'job_title', 'division','email','user_category','role_name','password','counter_wrong_pass','status_lock','locked_time','reset_by','reset_time','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array('user_id', 'company_name', 'company_phone', 'company_address', 'company_pic');
       return $str;
    }
	
	public static function get_user_category_list()
    {
		$arr = array('chamber', 'dashboard');
		return $arr;
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
