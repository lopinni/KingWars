<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous"> </script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
			integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
			crossorigin="anonymous"> </script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
			integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
			crossorigin="anonymous"> </script>

        <!-- Style -->
        <style>
            html, body {
                background-image: url("zamek.jpg");
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-size: 100% 100%;
            }
			img {
				width: 100%;
				height: auto;
				padding-top: 1px;
				padding-bottom: 1px;
				padding-left: 1px;
				padding-right: 1px;
			}
			.mapa { padding-top: 30px; }
        </style>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
			integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
			crossorigin="anonymous">

    </head>
	
    <body>
        <header>
        <!-- navbar -->
        @php
		
        $user= session('data')['LM1'];
        $uname=DB::table('players')->select('id','login')->where('login', $user)->orWhere('email', $user)->first();
		
		$active_v = session('active_village')['id'];
		
			#lista wiosek użytkownika
		$village_list = DB::table('villages')->select('id','name')->where('id_player', $uname->id)->orderBy('name')->get();

        @endphp

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">

             <a class="navbar-brand"> Gracz {{$uname->login}} </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
             </button>
            
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
			   <li class="nav-item">
                   <a class="nav-link" href="ranking">Ranking </a>
                 </li>
               <!-- obecne -->
                 <li class="nav-item">
                   <a class="nav-link" href="village_view">Wioska </a>
                 </li>
                 <!-- link -->
                 <li class="nav-item active">
                   <a class="nav-link" href="map_view">Mapa<span class="sr-only">(current)</span></a>
                 </li>

                 <!-- link -->
                 <li class="nav-item">
                   <a class="nav-link" href="profile">Profil</a>
                 </li>

                 <!-- link -->
                 <li class="nav-item">
                   <a class="nav-link" href="logout">Wyloguj się</a>
                 </li>
                 
               </ul>
             </div>
			</nav>
			
			<!-- Nowy kod -->
			<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(167, 172, 120, 0.473);">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						 
							@foreach ($village_list as $vlist)
								<li class=nav-link><a classnav-lin href="/map_view/{{$vlist->id}}">{{$vlist->name}}</a>  </li>
							@endforeach
					</ul>
				</div>
            </nav>
        </header>
		
		<div class="container inspect">
			<div style="background-color:rgba(245, 222, 179, 0.096)">
				
				<?php
				$tgt_id = session()->get('village_inspect')['id'];
				$tgt_data = DB::table('villages as v')->join('players as p', 'v.id_player', 'p.id')
					->select('v.name as vname', 'v.x_coordinate as x', 'v.y_coordinate as y', 'v.points as points', 'p.login as pname')
					->where('v.id', $tgt_id)->first();
					
				?>
				
				<div class="container">
					<div class="container text-center"><h4> {{$tgt_data->vname}}. </h4> </div>
					<div class="container text-center">
						<div class="container padding-top: 20px"> Lokacja na mapie: {{$tgt_data->x}}, {{$tgt_data->y}}.</div>

						<a href=/attack_form><button type="button"
							class="btn btn-dark">
							zaatakuj
						</button></a>

					</div>
				</div>


		</div>

    </body>
	
</html>
