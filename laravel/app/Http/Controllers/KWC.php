<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class KWC extends Controller
{
	
	public function admin(Request $request) {
		
		$name_email = strval($request->input('LM1'));
		$password = strval($request->input('LP1'));
		
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
		
		echo('Niepoprawna nazwa użytkownika i/lub hasło');
	}

	public function user(Request $request) {
		
		$name_email = strval($request->input('LM1'));
		$password = strval($request->input('LP1'));
		
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
					$request->session()->put('data', $request->input());
					
					return redirect('village_view');
				}
		}
		echo('Niepoprawna nazwa użytkownika i/lub hasło');
	}

	
	/*public function username_disp(){
		$dbkey = session('data')->get('LM1');

		$database = DB::table('players')
						->where('login','=',$dbkey)
						->first();
		if ($database!=NULL)
			return strval($dbkey);
		
		$database = DB::table('players')
						->where('emai;','=',$dbkey)
						->first();

		if ($database!=NULL){
			return strval(DB::table('players')
					->where('email','=', $dbkey)
					->get('name'));
		}
		echo("that's not supposed to happen");
	}*/

	public function register(Request $request){
		
		$name = strval($request->input('login1'));
		$email = strval($request->input('email1'));
		$password = strval($request->input('password1'));

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

			session()->put('data',['LM1'=>$name,'LP1'=>$password]);
			return redirect('new_village');
		}
		
		echo('Konto już istnieje');
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
		else
			return view('village_view');
	}
	
}
