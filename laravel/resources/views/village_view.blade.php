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
				padding-top: 10px;
				padding-bottom: 10px;
				padding-left: 10px;
				padding-right: 10px;
			}
			.col-md-6, .col-md-3 {
				padding-top: 30px;
				padding-bottom: 30px;
				padding-left: 30px;
				padding-right: 30px;
			}
        </style>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
			integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
			crossorigin="anonymous">

    </head>
	
    <body>
		
		
        <header>
		
		
		@php
		$user= session('data')['LM1'];
        $uname=DB::table('players')->select('id','login')->where('login', $user)->orWhere('email', $user)->first();
		 
		$av = session('active_village')['id'];
		#lista wiosek użytkownika
		$village_list = DB::table('villages')->select('id','name')->where('id_player', $uname->id)->orderBy('name')->get();
		
		
		$rathaus = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'ratusz')
							->first();

		$wood_quarry = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'tartak')
							->first();

		$steel_quarry = DB::table('village_buildings  as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'huta')
							->first();

		$brick_quarry = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'cegielnia')
							->first();

		$palace = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'pałac')
							->first();
		
		$soldier_quarry = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'koszary')
							->first();
		
		$unit_pikeman = DB::table('village_units')
							->select('number')
							->where('id_village', $av)
							->where('id_unit', '1')
							->first();

		$unit_swordman = DB::table('village_units')
							->select('number')
							->where('id_village', $av)
							->where('id_unit', '2')
							->first();
		
		$unit_axeman = DB::table('village_units')
							->select('number')
							->where('id_village', $av)
							->where('id_unit', '3')
							->first();

		$unit_knight = DB::table('village_units')
							->select('number')
							->where('id_village', $av)
							->where('id_unit', '4')
							->first();
		
		$unit_settler = DB::table('village_units')
							->select('number')
							->where('id_village', $av)
							->where('id_unit', '5')
							->first();

        @endphp
		<!-- navbar -->
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
							<a class="nav-link disabled" href="village_view">Wioska<span class="sr-only"> (current) </span></a>
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
			<!-- !Nowy kod -->
							
        </header>
		
		<div class="container-fluid">
			<div class="row">
			
				<!-- To z lewej -->
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"> Jednostki </h5>
							<div class="alert alert-secondary" role="alert">
								<p class="card-text"> Pikinierzy: {{$unit_pikeman->number }}</p>
								<p class="card-text"> Miecznicy: {{$unit_swordman->number }}</p>
								<p class="card-text"> Topornicy: {{$unit_axeman->number }}</p>
								<p class="card-text"> Rycerze: {{$unit_knight->number}}</p>
								<p class="card-text"> Osadnicy: {{$unit_settler->number }}</p>
							</div>

							<h5 class="card-title"> Raporty </h5>
							@php
								$reports = DB::select('select * from reports order by id desc limit 4');
							@endphp
									
							@foreach ($reports as $rep)
					
								@if ($rep->id_source == $uname->id)
									<div class="alert alert-warning" role="alert">
								@else
									<div class="alert alert-danger" role="alert">	
								@endif
										<h5> {{ $rep->sent }} - {{ $rep->type }} </h5>
										<hr class="my-1">
										{{ $rep->content }}
									</div>
					
							@endforeach
						</div>
					</div>
				</div>
			
				<!-- Budynki -->
				<div class="col-md-6">
				
					<!-- OBLICZANIE CZASU -->
					@php
						$last_log = DB::table('villages')
							->select('last_collected')
							->where('id',session()->get('active_village')['id'])
							->first();
						$nowy = strtotime($last_log->last_collected);
						$nowy2 = strtotime(date("Y-m-d h:i:s"));
						$hours = intval((($nowy2-$nowy)/3600));	
					@endphp
				
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src="ratusz.jpg" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Ratusz </h5>
									<p class="card-text"> Poziom: 
										@if ($rathaus == NULL)
											0
										@else
											{{$rathaus->level}}
										@endif
										</p>
									<a href=" {{ url("/castle") }} "
											class="btn btn-primary">
										Przejdź
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src="cegielnia.jpg" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Cegielnia </h5>
									<p class="card-text"> Poziom: {{$brick_quarry->level ?? 1}} Produkcja na godzinę:
										@if ($brick_quarry == NULL) 10
										@else {{($brick_quarry->level)*10}}
										@endif
									</p>
									
									@if ($hours > 0)
										<form action = "/AddBrick" method = "post">
											<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
											<button type="submit" class="btn btn-success">
												Zbierz surowce
											</button>
											<input type = "hidden"
													name = "addedBrick"
													value = "<?php echo(($brick_quarry->level)*10*$hours); ?>">
											<input type = "hidden"
													name = "villageID"
													value = "<?php echo(session()->get('active_village')['id']); ?>">
										</form>
									@else
										<button type="button" class="btn btn-success" disabled>
											Surowce sa dostępne co godzinę
										</button>
									@endif
									
								</div>
							</div>
						</div>
					</div>
					
					<hr class="my-4">
					
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src="koszary.jpg" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Koszary </h5>
									<p class="card-text"> Poziom: 
									@if ($soldier_quarry == NULL)
										0
									@else
										{{$soldier_quarry->level}}
									@endif
										. </p>
									<a href=" {{ url("/barracks") }} "
											class="btn btn-primary">
										Przejdź
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src="huta.jpg" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Huta stali </h5>
									<p class="card-text"> Poziom: {{$steel_quarry->level ?? 1}} Produkcja na godzinę:
										@if ($steel_quarry == NULL) 10
										@else {{($steel_quarry->level)*10}}
										@endif
									</p>
									
									@if ($hours > 0)
										<form action = "/AddSteel" method = "post">
											<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
											<button type="submit" class="btn btn-success">
												Zbierz surowce
											</button>
											<input type = "hidden"
													name = "addedSteel"
													value = "<?php echo(($steel_quarry->level)*10*$hours); ?>">
											<input type = "hidden"
													name = "villageID"
													value = "<?php echo(session()->get('active_village')['id']); ?>">
										</form>
									@else
										<button type="button" class="btn btn-success" disabled>
											Surowce sa dostępne co godzinę
										</button>
									@endif
									
								</div>
							</div>
						</div>
					</div>
					
					<hr class="my-4">
					
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src="pałac.jpg" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Pałac </h5>
									<p class="card-text"> Poziom: 
									@if ($palace == NULL)
										0
									@else
										{{$palace->level}}
									@endif
										. </p>
									<a href=" {{ url("/palace") }} "
											class="btn btn-primary">
										Przejdź
									</a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src="tartak.jpg" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Tartak </h5>
									<p class="card-text"> Poziom: {{$wood_quarry->level ?? 1}} Produkcja na godzinę:
										@if ($wood_quarry == NULL) 10
										@else {{($wood_quarry->level)*10}}
										@endif
									</p>
									
									@if ($hours > 0)
										<form action = "/AddWood" method = "post">
											<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
											<button type="submit" class="btn btn-success">
												Zbierz surowce
											</button>
											<input type = "hidden"
													name = "addedWood"
													value = "<?php echo(($wood_quarry->level)*10*$hours); ?>">
											<input type = "hidden"
													name = "villageID"
													value = "<?php echo(session()->get('active_village')['id']); ?>">
										</form>
									@else
										<button type="button" class="btn btn-success" disabled>
											Surowce sa dostępne co godzinę
										</button>
									@endif
									
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- To z prawej -->
				<div class="col-md-3">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"> Wiadomości </h5>
							<div class="alert alert-success" role="alert">
								<p class="card-text"> Tu będą wiadomości. </p>
							</div>
							<h5 class="card-title"> Aktualności </h5>
							@php
								$news = DB::select('select date, content from news order by id desc limit 4');
							@endphp
									
							@foreach ($news as $update)
					
							<div class="alert alert-info" role="alert">
								<h5> {{ $update->date }} </h5>
								<hr class="my-1">
								{{ $update->content }}
							</div>
					
							@endforeach
						</div>
					</div>
				</div>
				
			</div>
		</div>

    </body>
	
</html>