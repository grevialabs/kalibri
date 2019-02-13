<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // getorder_allowed_list
	public static function getorder_allowed_list()
    {
       static $str = array('transaction_id','site_id','user_id','article','customer_article','description','qty','value','status_in_out','reason_id','wo_wbs','remark');
       return $str;
    }
	
	// Allowed
	public static function required()
    {
       $str = array(
		'transaction_id', 'site_id', 'user_id', 'article', 'qty');
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
