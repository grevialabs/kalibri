<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlePoHistory extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('article_po_history_id','article_po_id','po_usage_qty','po_remaining_qty','po_created_date','status_in_out');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
        static $str = array('article_po_history_id','article_po_id','po_usage_qty','po_remaining_qty','po_created_date','status_in_out');
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
