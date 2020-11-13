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
	
}
