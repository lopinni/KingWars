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
		</style>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
			integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
			crossorigin="anonymous">

    </head>
	
	<body>
	@php
		$user= session('data')['LM1'];
        $uname=DB::table('players')->select('id','login')->where('login', $user)->orWhere('email', $user)->first();
		 

		#lista wiosek użytkownika
		$village_list = DB::table('villages')->select('id','name')->where('id_player', $uname->id)->orderBy('name')->get();

		$resources = DB::table('villages')->select('steel', 'wood', 'brick')->where('id', session('active_village')['id'])->first();


	@endphp
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">

		<a class="navbar-brand"> Gracz {{$uname->login}} </a>
		   <button class="navbar-toggler"
				   type="button"
				   data-toggle="collapse"
				   data-target="#navbarSupportedContent"
				   aria-controls="navbarSupportedContent"
				   aria-expanded="false"
				   aria-label="Toggle navigation">
			   <span class="navbar-toggler-icon"> </span>
		   </button>
		   <div class="collapse navbar-collapse" id="navbarSupportedContent">
			   <ul class="navbar-nav mr-auto">
				   <li class="nav-item">
					   <a class="nav-link" href="ranking">Ranking </a>
				   </li>
				   <!-- obecne -->
				   <li class="nav-item active">
					   <a class="nav-link" href="village_view">Wioska<span class="sr-only"> (current) </span></a>
				   </li>
				   <!-- link -->
				   <li class="nav-item">
					   <a class="nav-link" href="map_view"> Mapa </a>
				   </li>
				   <!-- link -->
				   <li class="nav-item">
					   <a class="nav-link" href="profile"> Profil </a>
				   </li>
				   <!-- link -->
				   <li class="nav-item">
					   <a class="nav-link" href="logout"> Wyloguj się </a>
				   </li>
			   </ul>
		   </div>
		</nav>
		   
		<!-- wioska -->
		<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(167, 172, 120, 0.473);">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					
						
						@foreach ($village_list as $vlist)

							@if ($vlist->id == session()->get('active_village')['id'])
								<li class="nav-item">{{$vlist->name}}</li>

							@else
							
							<li class=nav-link><a classnav-lin href="/village_view/{{$vlist->id}}">{{$vlist->name}}</a>  </li>
								
							@endif
						
						@endforeach
				</ul>
			</div>
		</nav>

		<div class="container" style="padding-top:30px;">
			<div class="container" style="background-color:wheat">
				<div class="container" style="padding-top:10px;">
					<div class="container" style="background-color:lightgrey;">
						<h4 class="text-center">
							Surowce: drewno {{$resources->wood ?? 0}},
							stal {{$resources->steel ?? 0}},
							cegła {{$resources->brick ?? 0}}
					</div>
				</div>
				
				@php
					$buildings = DB::table('village_buildings')
										->select('id_building','level')
										->where('id_village',session()->get('active_village')['id'])->get();
					$castle = DB::table('village_buildings')
										->select('level')
										->where('id_village',session()->get('active_village')['id'])
										->where('id_building',1)->first();
				@endphp
				
				<div class="jumbotron" style="background-color:wheat">
					<h1 class="display-5">
						Siedziba główna wioski (poziom {{$castle->level}})
					</h1>
					<!--
					<hr class="my-4">
					<h3> Kolejka konstrukcji </h3>
					<table style="width:100%; background-color:lightgrey;">
						<tr>
							<th> Zlecenie konstrukcji </th>
							<th> Pozostały czas </th>
							<th> Czas ukończenia </th>
							<th> Przerwanie </th>
						</tr>
						<tr>
							<td> (budynek, poziom) </td>
							<td> (hh:mm::ss) </td>
							<td> (hh:mm:ss) </td>
							<td> (przycisk/link anuluj) </td>
						</tr>
					</table> -->
					
					<hr class="my-4">
					<h3> Konstrukcja </h3>
					<table style="width:100%; background-color:lightgrey;">
						<tr>
							<th> Budynki </th>
							<th> Poziom </th>
							<th> Wymagania </th>
							<th> Konstruuj </th>
						</tr>
						
						@foreach ($buildings as $b) @unless (DB::table('buildings')
																->select('name')
																->where('id',$b->id_building+$b->level)
																->first() == NULL)
						<tr>
							<td> @php echo(DB::table('buildings')
												->select('name')
												->where('id',$b->id_building)
												->first()->name);
								@endphp </td>
							<td> {{$b->level+1}} </td>
							<td> @php echo("Cegła: ".
											DB::table('buildings')
												->select('cost_brick')
												->where('id',$b->id_building+$b->level)
												->first()->cost_brick.
											" Drewno: ".
											DB::table('buildings')
												->select('cost_wood')
												->where('id',$b->id_building+$b->level)
												->first()->cost_wood);
								@endphp </td>
							<td>
								<form action = "/Build" method = "post">
									<input type = "hidden"
											name = "_token"
											value = "<?php echo csrf_token(); ?>">
									<input type = "hidden"
											name = "idBuilding"
											value = "<?php echo($b->id_building); ?>">
									<input type = "hidden"
											name = "idVillage"
											value = "<?php echo(session()->get('active_village')['id']); ?>">
									@if($resources->brick >= DB::table('buildings')
																->select('cost_brick')
																->where('id',$b->id_building+$b->level)
																->first()->cost_brick &&
										$resources->wood >= DB::table('buildings')
																->select('cost_wood')
																->where('id',$b->id_building+$b->level)
																->first()->cost_wood)
									<button type="submit"
											class="btn btn-danger">
										Buduj
									</button>
									@else
									<button type="button"
											class="btn disabled btn-danger">
										Buduj
									</button>
									@endif
								</form>
							</td>
						</tr>
						@endunless @endforeach
						
					</table> 
				</div>
			</div>
		</div>
	
	</body>
	
</html>