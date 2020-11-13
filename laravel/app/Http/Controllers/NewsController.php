<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
	public function index() {
		$news = DB::select(
			'select date, content
			from news
			order by id desc
			limit 3
		');
		return view('welcome',['news'=>$news]);
	}
	
	public function insert(Request $request) {
		$date = $request->input('date1');
		$content = $request->input('TA1');
		
		DB::table('news')->insert([
			'date'=>$date,
			'content'=>$content
		]);
		return view('admin');
	}
   
	public function change_unit(Request $request) {
		$name = $request->input('select1');
		$steel = $request->input('costS');
		$wood = $request->input('costW');
		
		DB::table('units')
			->where('name', $name)
			->update([
				'cost_steel'=>$steel,
				'cost_wood'=>$wood
			]);
		return view('admin');
	}
   
	public function change_building(Request $request) {
		$name = $request->input('select2');
		$level = $request->input('select3');
		$brick = $request->input('costB2');
		$wood = $request->input('costW2');
		
		DB::table('buildings')
			->where([
				['name', '=', $name],
				['level', '=', $level],
			])
			->update([
				'cost_brick'=>$brick,
				'cost_wood'=>$wood
			]);
		return view('admin');
	}
	
	public function delete_player(Request $request) {
		$id = $request->input('idPlayer');
		
		DB::table('players')
			->where('id','=',$id)
			->delete();
		return view('admin');
	}
}
