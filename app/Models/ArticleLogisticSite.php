<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleLogisticSite extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('article_logistic_site_id','site_id','outbound_delivery','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('article_logistic_site_id','site_id','outbound_delivery','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
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
