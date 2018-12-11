<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class VerifyUser extends Eloquent
{
    protected $guarded = [];
	protected $connection = 'mongodb';
	protected $collection = 'verify_users';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
	
	
	
	
}
