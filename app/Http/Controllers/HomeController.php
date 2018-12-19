<?php

namespace App\Http\Controllers;

use App\Postcode;
use App\Book;
//use Illuminate\Http\Request;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;
use DB;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('backend.home');
    }

    public function createWriter() {
        $role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit articles']);
        echo 'done';
    }

    public function createAdmin() {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit all']);
        echo 'done';
    }

    public function createEditor() {
        $role = Role::create(['name' => 'editor']);
        $permission = Permission::create(['name' => 'edit costam']);
        echo 'done';
    }

    public function scopeDistance($query, $lat = 51.747829, $lng = -0.301865, $radius = 100, $unit = "km") {
        $unit = ($unit === "km") ? 6378.10 : 3963.17;
        $lat = (float) $lat;
        $lng = (float) $lng;
        $radius = (double) $radius;
        return $query->having('postcodes', '<=', $radius)
                        ->select(DB::raw("*,
                            ($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(latitude))
                                * COS(RADIANS($lng) - RADIANS(longitude))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(latitude)))) AS distance")
                        )->orderBy('distance', 'asc');
    }

    public function radiusSearch() {

        //ok
        //$locations = DB::collection('postcodes')->where('Location2', 'Cunningham')->get();
        //ok
        /*
          $locations = DB::collection('postcodes')
          //->where('Location2', 'Cunningham')
          ->having('Location2', 'LIKE', '%'.$radius.'%')
          ->get();
         */


        $latitude = 50.730733;
        $longitude = -1.860970;

        /*
          $locations = Postcode::where('location', 'near', [
          '$geometry' => [
          'type' => 'Point',
          'coordinates' => [-1.860970, 50.730733]
          ],
          '$maxDistance' => 5,
          ])->paginate(5);
         */



        /*
          $locations2 = Book::where('location', 'geoWithin', [
          '$center' => [
          'type' => 'Point',
          'coordinates' => [-1.850970,50.730733],
          ],
          '$maxDistance' => 5,
          ])->get();

         */

       //10000 Bournemouth + Poole
       //15000 Bournemouth + Poole + Ringwood
       //32000 Bournemouth + Poole + Ringwood + Beaulieu,
       //45000 Bournemouth + Poole + Ringwood + Beaulieu + Southampton ,
        
       $radius = 65000;
       $locations = Book::where('location', 'near', [
	'$geometry' => [
        'type' => 'Point',
	    'coordinates' => [-1.879586,50.742362 ],
            ],
            '$maxDistance' => $radius,
        ])->get();


        //dd($locations3);
        /*
          $locations3 =  Book::whereRaw([
          'location' => [
          '$near' => [-1.850970,50.730733],
          '$maxDistance' => 5,
          ],
          ])->get();
         */


        /*
          $locations  = Postcode::where('address', 'geoWithin', [
          '$centerSphere' => [
          [
          -0.301865,
          51.5069158,
          ],
          50 / 3963.2 // 50 mile (3963.2 = equatorial radius of the earth)
          ]
          ])->paginate(12);


          $locations2  = Postcode::raw()->find(array('location_coordinates' => array('$near' => array($longitude, $latitude))));
         */





        /*
          $locations  = DB::collection('postcodes')

          ->select('postcodes.id', 'title', 'city', 'price', 'postedat',
          ( '3959 * acos( cos( radians(37) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(-122) )
          + sin( radians(37) ) * sin( radians( lat ) ) ) as distance') )





          ->having('distance', '<', $radius)
          ->orderBy('distance', 'desc')
          ->get();
         */

        //dd($locations);

        /*
          $locations = DB::collection('postcodes')
          ->select("*,
          ($unit * ACOS(COS(RADIANS($lat))
         * COS(RADIANS(Lat))
         * COS(RADIANS($lng) - RADIANS(Long))
          + SIN(RADIANS($lat))
         * SIN(RADIANS(Lat)))) AS distance"
          )
          ->having('postcodes', '<=', $radius)
          ->get();
         */


        //$locations = DB::collection('postcodes')->select(' ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians( lat ) ) ) ) AS distance  HAVING distance < ' . $distance . '' );

        /*
          $locations = DB::collection('postcodes')
          ->select('( 3959 * acos( cos( radians(?) ) *
          cos( radians( lat ) )
         * cos( radians( lng ) - radians(?)
          ) + sin( radians(?) ) *
          sin( radians( lat ) ) )
          ) AS distance', [$lat, $lng, $lat])
          //->having("distance < ?", [$radius])
          ->get();
         */
        // dd($locations);


        /*
          $latitude = 51.747829;
          $longitude = -0.301865;

          $upper_latitude = $latitude + (.50); //Change .50 to small values
          $lower_latitude = $latitude - (.50); //Change .50 to small values
          $upper_longitude = $longitude + (.50); //Change .50 to small values
          $lower_longitude = $longitude - (.50); //Change .50 to small values

          $locations = \DB::collection('postcodes')
          ->whereBetween('geo_locations.latitude', [$lower_latitude, $upper_latitude])
          ->whereBetween('geo_locations.logitude', [$lower_longitude, $upper_longitude])
          ->get();
         */


        /*
          $locations = DB::collection('postcodes')
          ->select('* where Postcode result')
          ->get();
         */


        // dd( $locations);

        return view('radius', compact('locations'));
    }

}
