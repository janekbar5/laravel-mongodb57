<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Maklad\Permission\Models\Role;
use Maklad\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use Image;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('home');
    }

    public function getUsersList() {
        $users = User::all();
        return view('backend.users.getuserslist', compact('users'));
    }

    public function editUser($id) {        
        $user = User::find($id);
        dd($id);
        //return view('users.edituser', compact( 'user'));
    }

    public function edit($id) {
        $roles = Role::all();
        $user = User::find($id);
        $currentroles = $user->getRoleNames();
        return view('backend.users.edituser', compact('user', 'roles', 'currentroles', 'id'));
    }

    public function store(Request $request) {
        $user = User::find($request->Input('user_id'));
        //dd($request);
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);



        $user->update($request->all());
        $user->syncRoles($request->Input('roles'));


        //return redirect()->route('user.list')->with('success', 'Record created successfully.');
        Session::flash('alert-success', 'Record updated successfully');
        return redirect()->route('users.list');
    }

    public function getUserProfile() {
        //$profile = User::where('id','=', \Auth::user()->id)->first();
        $profile = \Auth::user();
        //dd($profile);
        return view('backend.users.profile', compact('profile'));
    }

    public function postUserProfile(Request $request) {
        //dd($request->all());	

        
        $user = \Auth::user();
        $user->update($request->all());        
        if($request->has('bio_file')){   
            $file = $request->file('bio_file');
            $extension = $file->getClientOriginalExtension(); 
            //$thumbs = Image::make($file)->resize(200, 200)->encode($extension);
            $thumb = \Image::make($file);
            $thumb->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
            $thumb->resizeCanvas(300, 300, 'center', false, array(255, 255, 255, 0));            
            $filename = \Auth::user()->id . '_' . str_random(6) . '.' . $extension;
            $thumb->save('uploads/' . $filename);        
            $user->bio_file=$filename;
            $user->update();
        }
        
        
        
        Session::flash('alert-success', 'Record updated successfully');
        //return redirect()->route('backend.books.index')->with('success','Book deleted successfully');
	return back();
    }

    public function createRoles() {
        $role = Role::create(['name' => 'writer']);
        $permission = Permission::create(['name' => 'edit articles']);
        echo 'done';
    }

    public function createAdmin() {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit all']);
        echo 'done';
    }

}
