<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleLogisticSiteDetail extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('article_logistic_site_detail_id','outbound_delivery','article','customer_article','description','qty_issue','conv_uom','qty_receive_actual','qty_receive','disc_minus','disc_plus','conversion_diff','dashboard_received_date','qty_chamber','chamber_disc_minus','chamber_disc_plus','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str = array('article_logistic_site_detail_id','outbound_delivery','article','customer_article','description','qty_issue','conv_uom','qty_receive_actual','qty_receive','disc_minus','disc_plus','conversion_diff','dashboard_received_date','qty_chamber','chamber_disc_minus','chamber_disc_plus','status', 'created_at','created_by','created_ip','updated_at','updated_by','updated_ip');
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
