<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class RfidArticle extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('rfid_article_id','site_id','outbound_delivery','article','description','rfid', 'picktime','user_id');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('rfid_article_id','site_id','outbound_delivery','article','description','rfid', 'picktime','user_id');
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
