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
	
	public function addBrick(Request $request) {
		$added_bricks = $request->input('addedBrick');
		$id = $request->input('villageID');
		$original_bricks = DB::table('villages')
							->select('brick')
							->where('id', $id)
							->first();
		$added_bricks += $original_bricks->brick;
		DB::table('villages')
			->where('id', $id)
			->update(['brick' => $added_bricks,
					'last_collected' => date("Y-m-d h:i:s")]);
		return view('village_view');
	}
	
	public function addSteel(Request $request) {
		$added_steel = $request->input('addedSteel');
		$id = $request->input('villageID');
		$original_steel = DB::table('villages')
							->select('steel')
							->where('id', $id)
							->first();
		$added_steel += $original_steel->steel;
		DB::table('villages')
			->where('id', $id)
			->update(['steel' => $added_steel,
					'last_collected' => date("Y-m-d h:i:s")]);
		return view('village_view');
	}
	
	public function addWood(Request $request) {
		$added_wood = $request->input('addedWood');
		$id = $request->input('villageID');
		$original_wood = DB::table('villages')
							->select('wood')
							->where('id', $id)
							->first();
		$added_wood += $original_wood->wood;
		DB::table('villages')
			->where('id', $id)
			->update(['wood' => $added_wood,
					'last_collected' => date("Y-m-d h:i:s")]);
		return view('village_view');
	}
	
	public function build(Request $request) {
		$idBuilding = intval($request->input('idBuilding'));
		$idVillage = intval($request->input('idVillage'));
		$level = intval(DB::table('village_buildings')
						->select('level')
						->where('id_building',$idBuilding)
						->where('id_village',$idVillage)
						->first()->level);
		DB::table('villages')
				->where('id',$idVillage)
				->decrement('brick',
					DB::table('buildings')
						->select('cost_brick')
						->where('id',$idBuilding+$level)
						->first()->cost_brick);
		DB::table('villages')
				->where('id',$idVillage)
				->decrement('wood',
					DB::table('buildings')
						->select('cost_wood')
						->where('id',$idBuilding+$level)
						->first()->cost_wood);
		DB::table('village_buildings')
					->where('id_building',$idBuilding)
					->where('id_village',$idVillage)
					->increment('level',1);
		return view('castle');
	}
}
