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
		$content = filter_var(strval($request->input('TA1')), FILTER_SANITIZE_STRING);
		
		DB::table('news')->insert([
			'date'=>$date,
			'content'=>$content
		]);
		return view('admin');
	}
   
	public function change_unit(Request $request) {
		$name = filter_var(strval($request->input('select1')), FILTER_SANITIZE_STRING);
		$steel = filter_var($request->input('costS'), FILTER_VALIDATE_INT);
		$wood = filter_var($request->input('costW'), FILTER_VALIDATE_INT);
		
		DB::table('units')
			->where('name', $name)
			->update([
				'cost_steel'=>$steel,
				'cost_wood'=>$wood
			]);
		return view('admin');
	}
   
	public function change_building(Request $request) {
		$name = filter_var(strval($request->input('select2')), FILTER_SANITIZE_STRING);
		$level = filter_var($request->input('select3'), FILTER_VALIDATE_INT);
		$brick = filter_var($request->input('costB2'), FILTER_VALIDATE_INT);
		$wood = filter_var($request->input('costW2'), FILTER_VALIDATE_INT);
		
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
