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

//use Illuminate\Routing\Route;

//use Illuminate\Routing\Route;

Route::get('/', function () {

    $data=[];
    $data['id'] = 5;
    $data['name'] = 'Ahmed Fandy';
    return view('welcome' , $data);
    // return view('welcome' , $data)->with(['name' => 'Ahmed Fandy' , 'age' =>'32']);

});


Route::get('index' , 'Front\UserController@getIndex');


Route::get('/test1', function () {
    return "Welcome";
});

Route::get('/test2/{id}', function ($id) {
    return $id;
});


Route::get('/test3/{id?}', function () {
    return "Welcome";
});


Route::get('/landing', function () {
    return view('landing');
});


Route::get('/master', function () {
    return view('layouts.master');
});


Route::get('/aboutus', function () {
    return view('aboutus');
});




Route::get('second' , 'Admin\SecondController@showString0')->middleware('auth');
Route::get('second1' , 'Admin\SecondController@showString1');
Route::get('second2' , 'Admin\SecondController@showString2');

Route::get('login' , function(){
    return "you must be logged in";
})->name('login');


Route::resource('news', 'NewController');

Auth::routes(['verify' =>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('fillable' , 'Front\CrudController@getoffers');




    Route::group(['prefix'     => LaravelLocalization::setLocale(), 
                  'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] 
                ],function(){
                    
        Route::group(['prefix'=> 'offers'] , function(){
        
            Route::get('create' , 'Front\CrudController@create');
            Route::post('store' , 'Front\CrudController@store')->name('offers.store');
        
    });

    
    
    

});