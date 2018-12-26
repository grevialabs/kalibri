<?php

namespace Patriot\Models\Scrapetw;

use Illuminate\Database\Eloquent\Model;

use DB;

class Scrape extends Model
{
    //
	protected $id = 'scrape_id';
	protected $primaryKey = 'scrape_id';
	protected $table = 'scr_scrape';
	
	public $timestamps = false;
	
}
