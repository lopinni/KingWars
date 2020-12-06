<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlayerController extends Controller
{
	
	public function ranking(Request $request) {
		$name = $request->session()->get('data');
		return view('ranking',['player_name'=>$name]);
	}
	
	public function error1() {
		$news = DB::select(
			'select date, content
			from news
			order by id desc
			limit 3
		');
		return view('error1',['news'=>$news]);
	}
	
	public function error2() {
		$news = DB::select(
			'select date, content
			from news
			order by id desc
			limit 3
		');
		return view('error2',['news'=>$news]);
	}
}
