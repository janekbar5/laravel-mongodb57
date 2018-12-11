<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/createwriter', 'HomeController@createWriter')->name('createwriter');
Route::get('/createadmin', 'HomeController@createAdmin')->name('createadmin');
Route::get('/createeditor', 'HomeController@createEditor')->name('createeditor');


Route::get('/profile',   'UserController@getUserProfile')->name('user.profile');
Route::post('/postprofile',   'UserController@postUserProfile')->name('user.postprofile');

Route::get('/getuserslist',   'UserController@getUsersList')->name('users.list');
Route::get('/edituser?{$id}', 'UserController@editUser')->name('user.edituser');
Route::post('/userstore',   'UserController@store')->name('user.store');
Route::get('edit/{id}','UserController@edit')->name('user.edit');


////////////////////////
Route::get('books/index', 'BooksController@index')->name('backend.books.index');
Route::get('books/create', 'BooksController@create')->name('backend.books.create');
Route::post('books/store', 'BooksController@store')->name('backend.books.store');
Route::get('books/index', 'BooksController@index')->name('backend.books.index');
Route::get('books/show/{id}', 'BooksController@show')->name('backend.books.show');
Route::get('books/edit/{id}', 'BooksController@edit')->name('backend.books.edit');
Route::post('books/edit/{id}', 'BooksController@update')->name('backend.books.update');
Route::post('books/delete/{id}', 'BooksController@destroy')->name('backend.books.destroy');
Route::delete('books/delete/{id}', 'BooksController@destroy')->name('backend.books.destroy');


Route::post('books/store_ajax', 'BooksController@storeAjax')->name('backend.books.store.ajax');
Route::get('books/edit_ajax/{id}', 'BooksController@editAjax')->name('backend.books.edit.ajax');

Route::get('books/create_ajax', 'BooksController@createAjax')->name('backend.books.create.ajax');
Route::post('books/create_ajax', 'BooksController@createAjaxPost')->name('backend.books.create.ajaxpost');

//Route::get('books/create_ajax', 'BooksController@createAjax')->name('backend.books.create.ajax');
//Route::post('books/create_ajax', 'BooksController@createAjaxPost')->name('backend.books.create.ajaxpost');
/////////////////////////////////
Route::get('categories/index', 'CategoriesController@index')->name('categories.index');
Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
Route::post('categories/store', 'CategoriesController@store')->name('categories.store');
Route::get('categories/index', 'CategoriesController@index')->name('categories.index');
Route::get('categories/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
Route::post('categories/edit/{id}', 'CategoriesController@update')->name('categories.update');
Route::get('categories/show/{id}', 'CategoriesController@show')->name('categories.show');
Route::delete('categories/delete/{id}', 'CategoriesController@destroy')->name('categories.destroy');
//////////////////////////////////
Route::post('model/getmodel', 'ModelsController@getModelsAjax')->name('models.index');
/////////////////////////////////
Route::get('tags/index', 'TagsController@index')->name('tags.index');
Route::get('tags/create', 'TagsController@create')->name('tags.create');
Route::post('tags/store', 'TagsController@store')->name('tags.store');
Route::get('tags/index', 'TagsController@index')->name('tags.index');
Route::get('tags/edit/{id}', 'TagsController@edit')->name('tags.edit');
Route::post('tags/edit/{id}', 'TagsController@update')->name('tags.update');
Route::get('tags/show/{id}', 'TagsController@show')->name('tags.show');
Route::delete('tags/delete/{id}', 'TagsController@destroy')->name('tags.destroy');
//////////////////////////////////
//Route::post('images/deleteimg', 'ImagesController@getImageDelete2')->name('images.store');	
Route::post('images/changeImageOrder', 'ImagesController@changeImageOrder')->name('images.store');	
Route::get('images/deleteimgwithvehicle/{id}', 'ImagesController@deleteImageswithVehicle')->name('images.store');
Route::get('images/deleteimg/{id}', 'ImagesController@getImageDelete')->name('images.delete');
//Route::post('images/deleteimg/{id}', 'ImagesController@getImageDelete')->name('images.delete');	
Route::post('/books/do-upload', 'ImagesController@postImageUpload')->name('images.upload');