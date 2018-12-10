<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Make extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'makes';
	
    
	
}
