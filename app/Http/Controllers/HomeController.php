<?php

namespace App\Http\Controllers;

use App\Postcode;
use Illuminate\Http\Request;
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

    public function scopeDistance($query, $lat=51.747829, $lng=-0.301865, $radius = 100, $unit = "km") {
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
        $lat = 51.747829;
        $lon = -0.301865; 
        $radius = 5;
        
       $locations = DB::collection('postcodes')->where('Location2', 'Cunningham')->get();

        //dd($locations);



        return view('radius', compact('locations'));
    }

    

}
