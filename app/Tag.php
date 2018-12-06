<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use Illuminate\Database\Eloquent\Model;

class Tag extends Eloquent
{
	
	protected $connection = 'mongodb';
	protected $collection = 'tags';
	
	//protected $table = 'tags';
	
    protected $fillable = [
	'title',
	'description',
	];
	
	
	
	public function books()
    {
        //return $this->belongsToMany('App\Vehicle','vehicle_tag','vehicle_id','tag_id');
		return $this->belongsToMany('App\Book', null, 'book_ids', 'tag_ids');
    }
	
	
}
