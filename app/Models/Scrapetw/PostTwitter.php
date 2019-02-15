<?php

namespace Patriot\Models\Scrapetw;

use Illuminate\Database\Eloquent\Model;

use DB;

class PostTwitter extends Model
{
    //
	protected $id = 'post_twitter_id';
	protected $primaryKey = 'post_twitter_id';
	protected $table = 'scr_post_twitter';
	
	public $timestamps = false;
	
}
