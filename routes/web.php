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
Route::redirect('/', '/login');

Route::get('/working','ManagerController@index');
Route::get('/workingblade','ManagerController@indexBlade');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//evolução das rotas
/*
Route::get('/admin/Day_records', 'Admin\\Day_recordsController@index')->name('Day_records');
Route::get('/admin/Monthly_report', 'Admin\\Monthly_reportController@index')->name('Monthly_report');
Route::get('/admin/Manager_report', 'Admin\\Manager_reportController@index')->name('Manager_report');
Route::get('/admin/Page_users', 'Admin\\PageusersController@index')->name('Page_users');

Route::get('/admin/Save_user', 'Admin\\Save_userController@index')->name('Save_user');
Route::post('/admin/Save_user', 'Admin\\Save_userController@create')->name('Save_create');
*/
/*
Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::get('/Day_records', 'Day_recordsController@index')->name('Day_records');
    Route::get('/Monthly_report', 'Monthly_reportController@index')->name('Monthly_report');
    Route::get('/Manager_report', 'Manager_reportController@index')->name('Manager_report');
    Route::get('/Page_users', 'PageusersController@index')->name('Page_users');

    Route::get('/Save_user', 'Save_userController@index')->name('Save_user');
    Route::post('/Save_user', 'Save_userController@create')->name('Save_create');
    Route::get('/destroy/{Save_user}', 'PageusersController@destroy')->name('destroy_user');


    Route::get('/{Save_user}/edit', 'Save_userController@edit')->name('Save_edit');
    Route::post('/update/{userUnic}', 'Save_userController@update')->name('Save_update');
    
});

*/ 
//adicionando o midlueare
Route::group(['middleware'=>['auth']],function(){

    Route::prefix('admin')->namespace('Admin')->group(function(){
        Route::get('/Day_records', 'Day_recordsController@index')->name('Day_records');
        Route::get('/Day_records/innout','Day_recordsController@innout')->name('innout');
        Route::post('/Day_records/innout2','Day_recordsController@innout2')->name('innout2');
        

        Route::get('/Monthly_report', 'Monthly_reportController@index')->name('Monthly_report');
        Route::post('/Monthly_report/post', 'Monthly_reportController@post')->name('Monthly_post');

        Route::get('/Manager_report', 'Manager_reportController@index')->name('Manager_report');
        Route::get('/Page_users', 'PageusersController@index')->name('Page_users');
    
        Route::get('/Save_user', 'Save_userController@index')->name('Save_user');
        Route::post('/Save_user', 'Save_userController@create')->name('Save_create');
        Route::get('/destroy/{Save_user}', 'PageusersController@destroy')->name('destroy_user');
    
    
        Route::get('/{Save_user}/edit', 'Save_userController@edit')->name('Save_edit');
        Route::post('/update/{userUnic}', 'Save_userController@update')->name('Save_update');
        
    });

});


