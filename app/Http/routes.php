<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('tes', function () {
    // return phpinfo() ;
    $a = Hash::make('bismillah');
    echo $a;
});

Route::get('/pui-lembaga', 'SaveToCollection@index');
Route::get('/pui-lembaga/store', 'SaveToCollection@store');
Route::get('/pui-produk/store', 'SaveToCollection@storeProduk');
// Route::get('/pui-lembaga/storetes', 'SaveToCollection@storetes');
Route::get('/pui-lembaga/show', 'SaveToCollection@show');
Route::get('/pui-produk/show', 'SaveToCollection@showProduk');

Route::get('/oai', 'OaiController@index');
Route::get('/oai/tes', 'OaiController@tes');
Route::get('/oai/list', 'OaiController@getAvailableMetadataFormats');
Route::get('/oai/records', 'OaiController@getRecords');

Route::get('/rml/get-active/', 'RMLController@getActive');
Route::get('/rml/get-service-name/', 'RMLController@getServiceName');
Route::get('/rml/get-active-count/', 'RMLController@getActiveCount');
Route::post('/rml/submit', 'RMLController@store');


Route::get('/updater/update/', 'WebServiceUpdater@updateLocal');
//laravel queue
Route::get('/updater/updateId/{id}', 'WebServiceUpdater@UpdateByIdAsync');

Route::get('/updater/update/{type}', 'WebServiceUpdater@updateByType');


Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/chart/getKategoriLembaga', 'DashboardController@getKategoriLembaga');
Route::get('/chart/getBentukLembaga', 'DashboardController@getBentukLembaga');
Route::get('/chart/getLembagaInduk', 'DashboardController@getLembagaInduk');
Route::get('/chart/getFokusBidang', 'DashboardController@getFokusBidang');
Route::get('/chart/getTrl', 'DashboardController@getTrl');
Route::get('/search', 'SearchController@index');
Route::get('/search/submit', 'SearchController@doSearch');

    
Route::group(['middleware' => ['web', 'auth']], function () {
	Route::get('/dashboard','DashboardController@frontpage');

    
    Route::get('/rml/input/{status?}', 'RMLController@create')->name('inputRML');
    Route::get('/rml/edit/{id}', 'RMLController@edit')->name('editRML');
    Route::get('/rml', 'DashboardController@rml')->name('rml');

    Route::get('/datatables/getRml', 'RMLController@getAllDt');



   

});

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
     Route::resource('user','userController');
    Route::get('getUser','userController@getUser');
    Route::get('userProfile','userController@userProfile');

});
