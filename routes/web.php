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

use App\Models\Hospital;

define('PAGINATION_COUNT' , 3);

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
})->name('master');


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


            Route::get('edit/{offer_id}' , 'Front\CrudController@editOffer')->name('offers.edit');
            // Route::post('update/{offer_id}' , 'Front\CrudController@updateOffer')->name('offers.update');

            Route::post('update/{offer_id}' , 'Front\CrudController@updateOffer')->name('offers.update');
            Route::get('delete/{offer_id}' , 'Front\CrudController@delete')->name('offers.delete');


            Route::get('all' , 'Front\CrudController@getAllOffers')->name('offers.all');
            Route::get('get-all-inactive-offer' , 'Front\CrudController@getAllInactiveOffers');


            
        
         });



    
          Route::get('youtube' , 'HomeController@getVideo')->middleware('auth');

    

});

Route::get('/dasboard' , function(){
    return 'Not Adult';
})->name('not.adult');


         ////////////////Ajax Route////////////////////
Route::group(['prefix'=> 'ajaxoffers'] , function(){
        
    Route::get('create' , 'OfferController@create');
    Route::post('store' , 'OfferController@store')->name('ajax.offers.store');
    Route::get('all' , 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete' , 'OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}' , 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update' , 'OfferController@update')->name('ajax.offers.update');


 });
 ////////////////End Ajax Route////////////////////


 ////////////////Begin Authentication Route////////////////////
 Route::group(['middleware'=>'CheckAge' , 'namespace'=>'Auth'],function () {

    Route::get('adualts','CustomeController@adualt')->name('adualts');

 });
 
 ////////////////End Authentication Route////////////////////


 Route::get('site','Auth\CustomeController@site')->middleware('auth:web')->name('site');
 Route::get('admin','Auth\CustomeController@admin')->middleware('auth:admin')->name('admin');
 Route::get('admin/login','Auth\CustomeController@adminLogin')->name('admin.login');
 Route::post('admin/login','Auth\CustomeController@checkAdminLogin')->name('save.admin.login');



###################### Begin Relations Routes  #######################
Route::get('has-one' , 'Relation\RelationController1@hasOneRelation');

Route::get('has-one-reverse' , 'Relation\RelationController1@hasOneRelationReverse');

Route::get('get-user-has-phone' , 'Relation\RelationController1@getUserHasPhone');

Route::get('get-user-not-has-phone' , 'Relation\RelationController1@getUserNotHasPhone');

Route::get('get-user-has-phone-with-condition' , 'Relation\RelationController1@getUserHasPhoneWithCondition');

###################### Begin One to Many Relations Routes  #######################
Route::get('hospital-has-many' , 'Relation\RelationController1@getHospitalDoctors');

Route::get('hospitals' , 'Relation\RelationController1@hospitals')->name('hospitals.all');

Route::get('doctors/{hospital_id}' , 'Relation\RelationController1@doctors')->name('hospitals.doctors');

Route::get('hospitals/{hospital_id}' , 'Relation\RelationController1@deleteHospitals')->name('delete.hospitals');

Route::get('hospitals-has-doctors' , 'Relation\RelationController1@hospitalsHasDoctors');

Route::get('hospitals-has-doctors-male' , 'Relation\RelationController1@hospitalsHasOnlyMaleDoctors');

Route::get('hospitals-not-has-doctors' , 'Relation\RelationController1@hospitalsNotHasDoctors');

###################### End One to Many Relations Routes  #######################

###################### Begin Many to Many Relations Routes  #######################
Route::get('doctors-services' , 'Relation\RelationController1@getDoctorsServices');
Route::get('services-doctors' , 'Relation\RelationController1@getServicesDoctors');
Route::get('services/doctors/{doctor_id}' , 'Relation\RelationController1@getDoctorsServicesById')->name('doctors.services');
Route::post('Saveservices-to-doctor' , 'Relation\RelationController1@saveServicesToDoctors')->name('save.doctors.services');

###################### End Many to Many Relations Routes  #######################

###################### has one through  #########################################
Route::get('has-one-through' , 'Relation\RelationController1@getPatientsDoctors');
Route::get('has-many-through' , 'Relation\RelationController1@getCountryDoctors');


#######################  Begin accessors and mutators ###################

Route::get('accessors','Relation\RelationsController@getDoctors'); //get data

#######################  End accessors and mutators ###################





