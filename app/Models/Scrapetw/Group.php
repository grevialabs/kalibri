<?php

namespace Patriot\Models\Scrapetw;

use Illuminate\Database\Eloquent\Model;

use DB;

class Group extends Model
{
    //
	protected $id = 'group_id';
	protected $primaryKey = 'group_id';
	protected $table = 'scr_group';
	
	public $timestamps = false;
	
}
