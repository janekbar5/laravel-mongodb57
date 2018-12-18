<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//use App\Category;
use Malhal\Geographical;

class Postcode extends Eloquent {
   
    //use Geographical;
    
    protected $connection = 'mongodb';
    protected $collection = 'postcodes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Postcode', 'Lat', 'Long'
    ];



}
