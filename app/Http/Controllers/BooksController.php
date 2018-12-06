<?php


namespace App\Http\Controllers;
use App\Book;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use Session;



class BooksController extends Controller

{
    protected $categoryObject;
    


    public function __construct()
    {
        $this->middleware('auth');
	//$this->categoryObject = $categoryObject;
    }
	
    public function getCategories(){
        //return $categories = Category::pluck('name', 'id');
        return $categories = Category::all();
    }
	
	
    
     
    public function index()
    {
        //$books = Book::all();
	//$books = Book::with('bookHasCategory')->get();
	$books = Book::where('user_id','=', \Auth::user()->id)->paginate(10);
        //$categories = $this->getCategories();
        return view('backend.books.index',compact('books'));
        //return view('books.index',compact('books'))->with('i', (request()->input('page', 1) - 1) * 5);
			//return 'rrrrrrrrrrrrrrrrr';
    }


    public function create()
    {
        $categories = $this->getCategories();
        $tags = Tag::all();
        return view('backend.books.create',compact('categories','tags'));
    }


  
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
        ]);  
       
        
        
       
        
        $book = Book::create($request->all());
        $book->user_id = \Auth::user()->id;
        $book->update();
        
        $book->tags()->sync($request->Input('tags'));
        //return redirect()->route('books.index')->with('success','Book created successfully.');
        Session::flash('alert-success', 'Record created successfully');
        return redirect()->route('backend.books.edit', $book->id);
    }


    
    
    public function show($id)
    {
        $tags = Tag::all();
	$book = Book::find($id);
	return view('backend.books.show',compact('book','tags'));
    }


    
    
    public function edit($id)	
    {
        $book = Book::find($id);
        $categories = $this->getCategories();
        $category = Category::find($book->category_id);
        $tags = Tag::all();
        //dd($tags);
	return view('backend.books.edit',compact('book','categories','category','tags'));
    }


   
    
    
    
    public function update(Request $request, $id)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
            'category_id' => 'required',
        ]);

        $book = Book::find($id);
        $book->update($request->all());
        //dd($request->Input('tags'));
        $book->tags()->sync($request->Input('tags'));
        
        return redirect()->route('backend.books.index')
                         ->with('success','Book updated successfully');
    }
    
    
    
    
    
    public function destroy($id)
    {
        
	$book = Book::find($id);
	$book->delete();
        Session::flash('alert-success', 'Record deleted successfully');
        //return redirect()->route('backend.books.index')->with('success','Book deleted successfully');
	return redirect()->route('backend.books.index');
    }
	
	
	
	
}