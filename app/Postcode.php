<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Category;

class Postcode extends Eloquent {

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
