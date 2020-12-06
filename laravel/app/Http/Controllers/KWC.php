<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KWC extends Controller
{
	
	public function admin(Request $request) {
		$name_email = filter_var(strval($request->input('LM1')), FILTER_SANITIZE_STRING);
		$password = filter_var(strval($request->input('LP1')), FILTER_SANITIZE_STRING);
		$database = DB::table('admin')
						->where('login','=',$name_email)
						->first();			
		if($database!=NULL){
			if(
				!strcmp($name_email,$database->login) ||
				!strcmp($name_email,$database->email)
			)
				if(!strcmp($password,$database->password))
					return view('admin');
		}
		return view('error3');
	}

	public function user(Request $request) {
		$name_email = filter_var(strval($request->input('LM1')), FILTER_SANITIZE_STRING);
		$password = filter_var(strval($request->input('LP1')), FILTER_SANITIZE_STRING);
		$database = DB::table('players')
						->where('login','=',$name_email)
						->orWhere('email', '=', $name_email)
						->first();		
		if($database!=NULL){
			if(
				!strcmp($name_email,$database->login) ||
				!strcmp($name_email,$database->email)
			)
				if(!strcmp($password,$database->password)){
					$pid = DB::table('players')
							->select('id', 'login')
							->where('login', $name_email)
							->orWhere('email', $name_email)
							->first();
					$request->session()->put('data',['LM1'=>$pid->login,'LID1'=>$pid->id]);
					$base_village = DB::table('villages')
										->select('id', 'name')
										->where('id_player',$pid->id)
										->orderBy('name')
										->first();
					session()->put('active_village', ['id'=>$base_village->id, 'name'=>$base_village->name]);
					return redirect('village_view');
				}
		}
		return redirect('error1');
	}


	public function register(Request $request){
		$name = filter_var(strval($request->input('login1')), FILTER_SANITIZE_STRING);
		$email = filter_var(strval($request->input('email1')), FILTER_SANITIZE_STRING);
		$password = filter_var(strval($request->input('password1')), FILTER_SANITIZE_STRING);
		$database = DB::table('players')
						->where('login','=',$name)
						->first();
		if($database==NULL){
			DB::table('players')->insert([
				'login'=>$name,
				'email'=>$email,
				'password'=>$password,
				'salt'=>0,
				'points'=>0
			]);
			$pid = DB::table('users')->select('id')->where('login', $name)->first();
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


	public function new_village($name, $direction){
		$pid = session('data'['LID1']);
		$x_arr = DB::table('villages')
		->select('x_coordinate');
		$y_arr = DB::table('villages')
		->select('y_coordinate');
		$x;
		$y;
		switch($direction){
			case 1:
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
		$id_v = DB::table('villages')->insertGetId(['name' => $name, 'x_coordinate' => $x, 'y_coordinate' => $y, 'id_player' => $pid, 'steel' => 0, 'wood' => 0, 'brick' => 0]);

		DB::table('village_units')-> insert(['id_unit' => 1, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 2, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 3, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 4, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v],
											['id_unit' => 5, 'number' => 0, 'availible' => 0, 'id_village' -> $id_v]);

		
	}
	
}
