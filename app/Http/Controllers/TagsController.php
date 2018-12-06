<?php


namespace App\Http\Controllers;


use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class TagsController extends Controller

{
     public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	
	
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index',compact('tags'))->with('i', (request()->input('page', 1) - 1) * 5);
			//return 'rrrrrrrrrrrrrrrrr';
    }


    
    public function create()
    {
        return view('tags.create');
    }


    
	
	
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);


        Tag::create($request->all());


        return redirect()->route('tags.index')
                         ->with('success','Tag created successfully.');
    }


    
	
    public function show($id)
    {
        
		$tag = Tag::find($id);
		return view('tags.show',compact('tag'));
    }
	
	


    
    public function edit($id)	
    {
        $tag = Tag::find($id);
		return view('tags.edit',compact('tag'));
    }


   
    public function update(Request $request, $id)
    {
         request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $tag = Tag::find($id);
        $tag->update($request->all());


        return redirect()->route('tags.index')
                         ->with('success','tag updated successfully');
    }
   
   
   
   
   
    public function destroy($id)
    {
        
		$tag = Tag::find($id);
		$tag->delete();
        return redirect()->route('tag.index')
                         ->with('success','tag deleted successfully');		
		
    }
	
	
	
	
	
}