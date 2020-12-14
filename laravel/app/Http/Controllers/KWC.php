<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KWC extends Controller
{
	
	public function admin(Request $request) {
		$name_email = filter_var(strval($request->input('LM1')),
									FILTER_SANITIZE_STRING);
		$password = hash('sha512',
						filter_var(strval($request->input('LP1')),
									FILTER_SANITIZE_STRING));
		$database = DB::table('admin')
						->where('login','=',$name_email)
						->first();			
		if($database!=NULL){
			if( !strcmp($name_email,$database->login) ||
				!strcmp($name_email,$database->email) )
				if(!strcmp($password,$database->password))
					return view('admin');
		}
		return view('error3');
	}

	public function user(Request $request) {
		$name_email = filter_var(strval($request->input('LM1')),
								FILTER_SANITIZE_STRING);
		$password = hash('sha512',filter_var(strval($request->input('LP1')),
								FILTER_SANITIZE_STRING));
		$database = DB::table('players')
						->where('login','=',$name_email)
						->orWhere('email', '=', $name_email)
						->first();		
		if($database!=NULL){
			if(!strcmp($name_email,$database->login) || 
				!strcmp($name_email,$database->email))
				if(!strcmp($password,$database->password)){
					$pid = DB::table('players')
							->select('id', 'login')
							->where('login', $name_email)
							->orWhere('email', $name_email)
							->first();
					$request->session()->put('data',
								['LM1'=>$pid->login,'LID1'=>$pid->id]);
					$base_village = DB::table('villages')
										->select('id', 'name')
										->where('id_player',$pid->id)
										->orderBy('name')
										->first();
					if ($base_village == NULL){
						return redirect('/village_view');
					}
					else{
						session()->put('active_village',
									['id'=>$base_village->id,
									'name'=>$base_village->name]);
						return redirect('village_view');
					}
				}
		}
		return redirect('error1');
	}


	public function register(Request $request){
		$name = filter_var(strval($request->input('login1')),
							FILTER_SANITIZE_STRING);
		$email = filter_var(strval($request->input('email1')),
							FILTER_SANITIZE_STRING);
		$password = hash('sha512',
						filter_var(strval($request->input('password1')),
							FILTER_SANITIZE_STRING));
		$database = DB::table('players')
						->where('login','=',$name)
						->first();
		if($database==NULL){
			DB::table('players')->insert([
				'login'=>$name,
				'email'=>$email,
				'password'=>$password,
				'points'=>0
			]);
			$pid = DB::table('players')
						->select('id')
						->where('login', $name)
						->first();
			session()->put('data',['LM1'=>$name,'LID1'=>$pid->id]);
			return redirect('new_village');
		}
		return redirect('error2');
	}

	public function first_village (){
		$id = DB::table('players')
				->select('id')
				->where('login', session()->get('data')['LM1'])
				->orWhere('email', session()->get('data')['LM1'])
				->first();	

		if (DB::table('villages')
				->select('id_player')
				->where('id_player', $id->id)
				->first() == NULL)
			return redirect('new_village');
		else{
			return view('village_view');
		}	
	}


	public function new_village($direction){
		$pid = session('data'['LID1']); 
		$village_c = DB::table('villages') -> select('count id_player as count')->where("id_player", $pid);
		
		$x_arr = DB::table('villages')
		->select('x_coordinate');
		$y_arr = DB::table('villages')
		->select('y_coordinate');
		$x;
		$y;
		switch($direction){
			case 1://NW
				do{
					$x = rand(1, 50);
					$y = rand(1, 50);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 2://N
				do{
					$x = rand(1, 100);
					if ($x<=50)
						$y = rand(1, $x);
					else
						$y = rand(1, 100-($x-1));
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 3://NE
				do{
					$x = rand(51, 100);
					$y = rand(1, 50);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 4://E
				do{
					$y = rand(1, 100);
					if ($y<=50)
						$x = rand(100-($y-1), 100);
					else
						$x = rand($y, 100);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 5:
				do{
					$x = rand(51, 100);
					$y = rand(51, 100);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 6://S
				do{
					$x = rand(1, 100);
					if ($x<=50)
						$y = rand(100-($x-1), 100);
					else
						$y = rand($x, 100);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 7:
				do{
					$x = rand(1, 50);
					$y = rand(51, 100);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 8://W
				do{
					$y = rand(1, 100);
					if ($y<=50)
						$x = rand(1, $y);
					else
						$x = rand(1, 100-($y-1));
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;

			case 9:
				do{
					$x = rand(1, 100);
					$y = rand(1, 100);
				}	while (in_array($x, $x_arr->x_coordinate) && in_array($y, $y_arr->y_coordinate));
			break;
			default:
				return redirect('village_view');
			break;
		}
		
		$name = "wioska nr".$village_c." gracza ". session('data')['LM1'];
		$id_v = DB::table('villages')->insertGetId(['name' => $name, 'x_coordinate' => $x, 'y_coordinate' => $y, 'id_player' => $pid, 'steel' => 0, 'wood' => 0, 'brick' => 0]);

		DB::table('village_units')-> insert(['id_unit' => 1, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 2, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 3, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 4, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 5, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v]);
		DB::table('village_buildings')-> insert( ['id_building' => 1, 'level' => 1, 'id_village' -> $id_v],
												 ['id_building' => 5, 'level' => 1, 'id_village' -> $id_v],
												 ['id_building' => 9, 'level' => 1, 'id_village' -> $id_v],
												['id_building' => 13, 'level' => 1, 'id_village' -> $id_v],
												['id_building' => 17, 'level' => 1, 'id_village' -> $id_v],
												['id_building' => 21, 'level' => 1, 'id_village' -> $id_v]);
		session()->put('active_village',
		['id'=>$id_v,
		'name'=>$name]);
		return redirect('/village_view');
	}

	public function attack(Request $request){
		
		$vid = session('active_village')['id'];
		$tgt = session('village_inspect')['id'];
		$pikes = filter_var(intval($request->pikes));
		$swords = filter_var(intval($request->swords));
		$axes = filter_var(intval($request->axes));
		$knights = filter_var(intval($request->knights));
		$attack_loss_coeficcient = 0.2;
		$defender_loss_coefficient = 0.25;

		$pike_stats = DB::table('units')->select('attack, defense')->where('name', 'pikinier')->first();
		$sword_stats = DB::table('units')->select('attack, defense')->where('name', 'miecznik')->first();
		$axe_stats = DB::table('units')->select('attack, defense')->where('name', 'topornik')->first();
		$knights_stats = DB::table('units')->select('attack, defense')->where('name', 'rycerz')->first();

		$enemy_pikes = DB::table('village_units')->select('number')->where('id_village', $tgt)->where('id_unit', 1)->first();
		$enemy_swords = DB::table('village_units')->select('number')->where('id_village', $tgt)->where('id_unit', 2)->first();
		$enemy_axes = DB::table('village_units')->select('number')->where('id_village', $tgt)->where('id_unit', 3)->first();
		$enemy_knights = DB::table('village_units')->select('number')->where('id_village', $tgt)->where('id_unit', 4)->first();


		$attack = $pikes*$pike_stats->attack+$axes*$axe_stats->attack+$swords*$sword_stats->attack+$knights*$knight_stats->attack;
		$defense = $enemy_pikes->number*$pike_stats->defense+$enemy_axes->number*$axe_stats->defense+$enemy_swords->number*$sword_stats->defense+$enemy_knights->number*$knight_stats->defense;

		if ($attack == $defense){
			session()->forget('village_inspect');
			return redirect("/village_view");
		}

		if ($attack > $defense ){
			DB::table('village_units')->where('id_village', $tgt)->where('id_unit', 1)->decrement('number', round($enemy_pikes*$defender_loss_coefficient));
			DB::table('village_units')->where('id_village', $tgt)->where('id_unit', 2)->decrement('number', round($enemy_swords*$defender_loss_coefficient));
			DB::table('village_units')->where('id_village', $tgt)->where('id_unit', 3)->decrement('number', round($enemy_axes*$defender_loss_coefficient));
			DB::table('village_units')->where('id_village', $tgt)->where('id_unit', 4)->decrement('number', round($enemy_knights*$defender_loss_coefficient));
			session()->forget('village_inspect');
			return redirect("/village_view");
		}
		if ($attack < $defense){
			DB::table('village_units')->where('id_village', $vid)->where('id_unit', 1)->decrement('number', round($pikes*$attack_loss_coefficient));
			DB::table('village_units')->where('id_village', $vid)->where('id_unit', 2)->decrement('number', round($swords*$attack_loss_coefficient));
			DB::table('village_units')->where('id_village', $vid)->where('id_unit', 3)->decrement('number', round($axes*$attack_loss_coefficient));
			DB::table('village_units')->where('id_village', $vid)->where('id_unit', 4)->decrement('number', round($knights*$attack_loss_coefficient));
			session()->forget('village_inspect');
			return redirect("/village_view");
		}
		else{
			session()->forget('village_inspect');
			return redirect("/village_view");
		}

	}
	
}
