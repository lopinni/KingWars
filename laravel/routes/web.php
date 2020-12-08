<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[
    'uses' => 'NewsController@index'
]);

Route::get('/error1',[
    'uses' => 'Playercontroller@error1'
]);

Route::get('/error2',[
    'uses' => 'Playercontroller@error2'
]);

Route::get ('/admin', function () {
   return view('admin_form');
});

Route::get ('/reg', function () {
   return view('reg_form');
});

Route::get('/LogUser', function () {
    return view('village_view');
});

Route::get('/new_village', function () {
   return view('new_village');
});

Route::get('/village_view', 'KWC@first_village');

Route::get('/village_view/{id}', function ($id){

	$name = DB::table('villages')
					->select('id', 'name')
					->where('id', $id)
					->first();
	session()->put('active_village', ['id'=>$name->id, 'name'=>$name->name]);
    return redirect('village_view');
   
});

Route::get('/map_view', function () {
   return view('map_view');
});

Route::get('/map_view/{id}', function ($id){

	$name = DB::table('villages')
					->select('id', 'name')
					->where('id', $id)
					->first();
   session()->put('active_village', ['id'=>$name->id, 'name'=>$name->name]);
   return redirect('map_view');
   
});

Route::get('/village_inspect/{id}', function ($id){

	$name = DB::table('villages')
					->select('id')
					->where('id', $id)
					->first();
   session()->put('village_inspect', ['id'=>$name->id]);
   return redirect('village_inspect');
   
});

Route::get('/ranking', function () {
   return view('ranking');
});

Route::get('/profile', function () {
   return view('profile');
});

Route::get('/logout', function () {
   session()->flush();
   return redirect('/');
});

Route::get('/castle', function () {
   return view('castle');
});

Route::get('/barracks', function () {
   return view('barracks');
});

Route::get('/palace', function () {
   return view('palace');
});


Route::post('cache_village', 'KWC@cache_village');

Route::post('PostNews','NewsController@insert');

Route::post('CostUnits','NewsController@change_unit');

Route::post('CostBuildings','NewsController@change_building');

Route::post('DeletePlayer','NewsController@delete_player');

Route::post('LogAdmin','KWC@admin');

Route::post('LogUser','KWC@user');

Route::post('RegUser','KWC@register');

Route::post('AddBrick','Playercontroller@addBrick');

Route::post('AddSteel','Playercontroller@addSteel');

Route::post('AddWood','Playercontroller@addWood');

Route::post('/null', function () {
});