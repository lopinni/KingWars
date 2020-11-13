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
					$pid = DB::table('players')->select('id')->where('login', $name_email)->orWhere('email', $name_email)->first();
					$$base_villag = DB::table('villages')->select('id', 'name')->where('id_player',$pid->id)->orderBy('name')->first();
					session()->put('active_village', ['id'=>$base_village->id, 'name'=>$base_village->name]);

					return redirect('village_view');
				}
		}
		echo('Niepoprawna nazwa użytkownika i/lub hasło');
	}


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
		else{
			
			return view('village_view');
		}
			
	}

	public function cache_village(Request $request){
		$id = $request->input('id_village');
		$name = DB::table('villages')
					->select('name')
					->where('id', $id)
					->first()->get();
		session()->forget('active_village',['id',' name']);
		session()->put('active_village', ['id'=>$id, 'name'=>$name]);
		return view('village_view');
	}
	
}
