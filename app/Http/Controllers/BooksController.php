<?php


namespace App\Http\Controllers;
use App\Book;
use App\Tag;
use App\Category;
use App\Make;
use App\Modell;
use Illuminate\Http\Request;
use Session;
use Response;
use Validator;

class BooksController extends Controller

{
    protected $categoryObject;
    


    public function __construct()
    {
        $this->middleware('auth');
	//$this->categoryObject = $categoryObject;
    }

    
    
    public function formValidator(array $data) {
        //////////custom message
        $messsages = array(
            'title.required' => 'You cant leave title field empty',
            'description.required' => 'You cant leave description field empty',
            'make_id.required' => 'You cant leave make field empty',
            'model_id.required' => 'You cant leave model field empty',
            'catrgory_id.required' => 'You cant leave category field empty',
            'tags.required' => 'You cant leave tags field empty',
        );


        $rules = array(
            'title' => 'required',
            'description' => 'required',
            'make_id' => 'required',
            'model_id' => 'required',
            'category_id' => 'required',
            'tags' => 'required',
            
        );

        return Validator::make($data, $rules, $messsages);
    }
    
    
    
    
    
    public function getCategories(){
        //return $categories = Category::pluck('name', 'id');
        return $categories = Category::all();
    }
	
	
    
     
    public function index()
    {
        
	$books = Book::where('user_id','=', \Auth::user()->id)->paginate(10);       
        return view('backend.books.index',compact('books'));
        
    }


    public function create()
    {
        $categories = $this->getCategories();
        $tags = Tag::all();
        return view('backend.books.create',compact('categories','tags'));
    }
    
    
    
    

    public function createAjax() {
        $categories = $this->getCategories();
        $tags = Tag::all();
        $makes = app('App\Http\Controllers\MakesController')->getAllMakes();
        $models = app('App\Http\Controllers\ModelsController')->getAllModels();
        $user_id = \Auth::user()->id;
        //return view('books.create');
        return view('backend.books.create-ajax', compact('categories','tags','makes', 'models', 'user_id'));
    }
    
    
    
    public function createAjaxPost(Request $request) {
       //dd($request->all());

        $formValidator = $this->formValidator($request->all());

        if ($formValidator->passes()) {
            //$book = Book::create($request->all());
            
            $book = new Book();
            $book->title = $request->input('title');
            $book->make_id = $request->input('make_id');
            $book->model_id = $request->input('model_id');
            $book->category_id = $request->input('category_id');
            $book->colour_id = 1;
            $book->fuel_type_id = 1;
            $book->body_type_id = 1;
            $book->price = 5991;
            //$vehicle->manufactured_year = 2005;
            $book->description = $request->input('description');
             
            $book->user_id = \Auth::user()->id;
            //$token = str_random(20);
            //$vehicle->token = $token;
            $book->save();
            
            $book->tags()->sync($request->Input('tags'));
             
            return Response::json(['success' => '1', 'token' => $book->id]);
        } else {
            return Response::json(['errors' => $formValidator->errors()]);
        }
    }
    
    
    
    
    
    
    
    
    public function editAjax($id) {
        //$tags = \App\Tag::pluck('name', 'id');
        $currentTags = [];
        //$book = Book::orderBy('created_at', 'desc')
               // ->where('id', 'LIKE', '%' . $id . '%')
               // ->first();
        $book = Book::find($id);
        //dd($book);
        $makes = app('App\Http\Controllers\MakesController')->getAllMakes();
        //$make = Make::where('id', 'LIKE', '%' . $book->make_id. '%')->first();
        $make = Make::find($book->make_id);
        //dd($make);
        $models = app('App\Http\Controllers\ModelsController')->getMakeModels($book->make_id);
        //$model = Modell::where('id', '=', $book->make_id)->first();
        $model = Modell::find($book->model_id);

        $categories = $this->getCategories();
        $category = Category::find($book->category_id);
        $tags = Tag::all();
        
        foreach ($book->tags as $tag) {
            $currentTags[] = $tag->id;
        }

        return view('backend.books.edit-ajax', compact('book', 'makes', 'make', 'models', 'model', 'tags', 'categories','category'));
    }
    
    
    
    
    
    
    public function storeAjax(Request $request) {
       //dd($request->all());

        $formValidator = $this->formValidator($request->all());

        if ($formValidator->passes()) {
            $book = Book::find($request->input('id'));
            //$book->location = ['type' => 'Point', 'coordinates' => [floatval($request->input('lng')), floatval($request->input('lat'))]];
            $book->location =  [floatval($request->input('lng')), floatval($request->input('lat'))];
            $book->title = $request->input('title');
            $book->save($request->all());   
            
            $book->tags()->sync($request->Input('tags'));
            
            return Response::json(['success' => '1']);
        } else {
            return Response::json(['errors' => $formValidator->errors()]);
        }
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