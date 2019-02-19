<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlePo extends Model
{
    // getorder_allowed_list
	public static function column_list()
    {
	   static $str = array('article_po_id','site_id','article','customer_article','description','po_blanket_number','po_blanket_qty','po_created_date');
       return $str;
	}
	
	// getorder_allowed_list
	public static function getorder_allowed_list()
    {
	   static $str =  array('article_po_id','site_id','article','customer_article','description','po_blanket_number','po_blanket_qty','po_created_date');
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
