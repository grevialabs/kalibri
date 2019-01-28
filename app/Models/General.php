<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('company_id','company_name','company_phone','company_address','company_pic');
       return $str;
    }
	
	// getorderby_allowed_list
	public static function getorderby_allowed_list()
    {
       static $str = array('desc','asc');
       return $str;
    }
	
	// $perpage_allowed = array(2,40,60)
	public static function perpage_allowed()
    {
       static $str = array(2,40,60);
       return $str;
    }
	
}
