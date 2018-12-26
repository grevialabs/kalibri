<?php

namespace Patriot\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Article extends Model
{
    
	protected $id = 'article_id';
	protected $table = 'grv_article';
	
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
	
	//
	const CREATED_AT = 'creator_date';
    const UPDATED_AT = 'editor_date';
	
	public static function get($attr = NULL)
	{
		if (! empty($_GET)) $attr = $_GET;
		
		$q = 'SELECT * FROM grv_article WHERE 1';
		
		if (isset($attr['article_id']) && $attr['article_id'] != 'article_id') {
			$q .= ' AND article_id = '. $attr['article_id'];
		}
		
		$q.= ' LIMIT 1';
		
		$data = DB::select($q);
		
		$data = $data[0];
		
		// if (isset($attr['format']) && $attr['format'] == 'json') $data = json_encode($data);
		
		return $data;
	}
	
	public static function get_list($attr = NULL)
	{
		if (! empty($_GET)) $attr = $_GET;
		
		$q = 'SELECT * FROM grv_article WHERE 1';
		
		if (isset($attr['article_id']) && $attr['article_id'] != 'article_id') {
			$q .= ' AND article_id = '. $attr['article_id'];
		}
		
		$data = DB::select($q);
		
		return $data;
	}
	
}
