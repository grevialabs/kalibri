<?php

namespace Patriot\Models\Scrapetw;

use Illuminate\Database\Eloquent\Model;

use DB;

class Username extends Model
{
    //
	protected $id = 'username_id';
	protected $primaryKey = 'username_id';
	protected $table = 'scr_username';
	
	public $timestamps = false;
	
	public static function test()
	{
		return 'koplak';
	}
	
}
