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

	$soldier_quarry = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'koszary')
							->orderByDesc('vb.level')
							->first();

	//$queue = DB::table('unit_queue as uq')->join('units as u', 'uq.id_unit', 'u.id')
				//->select('uq.seq_number as qnumber', 'u.name as uname', 'uq.number as number', 'uq.started as started', 'uq.completed as completed')
				//->where('uv.id_village', session('active_village')['id'])
				//->get();
				
	$pikinier = DB::table('units')
					->select('name','cost_steel','cost_wood')
					->where('id',1)->first();
	$miecznik = DB::table('units')
					->select('name','cost_steel','cost_wood')
					->where('id',2)->first();
	$topornik = DB::table('units')
					->select('name','cost_steel','cost_wood')
					->where('id',3)->first();
	$rycerz = DB::table('units')
					->select('name','cost_steel','cost_wood')
					->where('id',4)->first();

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
				<div class="jumbotron" style="background-color:wheat">
					<h1 class="display-5"> Koszary poziom {{$soldier_quarry->level}} </h1>
					<!-- <hr class="my-4">
					<h3> Kolejka rekrutacji </h3>
					<table style="width:100%; background-color:lightgrey;">
						<tr>
							<th> Zlecenie rekrutacji </th>
							<th> Pozostały czas </th>
							<th> Czas ukończenia </th>
							<th> Przerwanie </th>
						</tr>
						<tr>
							<td> (ilość, jednostka) </td>
							<td> (hh:mm:ss na wszystkie) </td>
							<td> (hh:mm:ss na wszystkie) </td>
							<td> (przycisk/link anuluj) </td>
						</tr>						
					</table> -->
					<hr class="my-4">
					<h3> Rekrutacja </h3>
					<table style="width:100%; background-color:lightgrey;">
						<tr>
							<th> Jednostki </th>
							<th> Wymagania </th>
							<th> Ilość </th>
							<!-- <th> Czas rekrutacji </th> -->
							<th> Rekrutuj </th>
						</tr>
						<tr>
							<td> {{$pikinier->name}} </td>
							<td> {{$pikinier->cost_steel}} stali, {{$pikinier->cost_wood}} drewna </td>
							<form method = "get">
								<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
								<td>
									<input type="number" class="form-control" id="pikinierN" name="pikinierN">
								</td>
								<td> <button type="submit"
											class="btn btn-primary"
											name="pikinierB"
											id="pikinierB">
										Rekrutuj
									</button>
								</td>
							</form>
						</tr>
						<tr>
							<td> {{$miecznik->name}} </td>
							<td> {{$miecznik->cost_steel}} stali, {{$miecznik->cost_wood}} drewna </td>
							<form method = "get">
								<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
								<td>
									<input type="number" class="form-control" id="miecznikN" name="miecznikN">
								</td>
								<td> <button type="submit"
											class="btn btn-primary"
											name="miecznikB"
											id="miecznikB">
										Rekrutuj
									</button>
								</td>
							</form>
						</tr>
						<tr>
							<td> {{$topornik->name}} </td>
							<td> {{$topornik->cost_steel}} stali, {{$topornik->cost_wood}} drewna </td>
							<form method = "get">
								<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
								<td>
									<input type="number" class="form-control" id="topornikN" name="topornikN">
								</td>
								<td> <button type="submit"
											class="btn btn-primary"
											name="topornikB"
											id="topornikB">
										Rekrutuj
									</button>
								</td>
							</form>
						</tr>
						<tr>
							<td> {{$rycerz->name}} </td>
							<td> {{$rycerz->cost_steel}} stali, {{$rycerz->cost_wood}} drewna </td>
							<form method = "get">
								<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
								<td>
									<input type="number" class="form-control" id="rycerzN" name="rycerzN">
								</td>
								<td> <button type="submit"
											class="btn btn-primary"
											name="rycerzB"
											id="rycerzB">
										Rekrutuj
									</button>
								</td>
							</form>
						</tr>
					</table> 
				</div>
			</div>
		</div>
	
		<?php
			if(isset($_GET['pikinierB'])) {
				$ilosc = filter_var(intval($_GET['pikinierN']),
							FILTER_SANITIZE_NUMBER_INT);
				$wwiosce = DB::table('village_units')->select('number')
								->where('id_unit',1)
								->where('id_village',session('active_village')['id'])
								->first();
				if($resources->steel >= ($ilosc*$pikinier->cost_steel) &&
					$resources->wood >= ($ilosc*$pikinier->cost_wood)){
					DB::table('village_units')
						->where('id_unit',1)
						->where('id_village',session('active_village')['id'])
						->update([
							'number' => ($wwiosce->number + $ilosc),
							'available' => ($wwiosce->number + $ilosc)
						]);
					DB::table('villages')
						->where('id',session('active_village')['id'])
						->update([
							'steel' => ($resources->steel - $pikinier->cost_steel*$ilosc),
							'wood' => ($resources->wood - $pikinier->cost_wood*$ilosc)
						]);
				}
				else echo '<script type="text/JavaScript">
							alert("Za mało surowców");
						</script>';
			}
			
			if(isset($_GET['miecznikB'])) {
				$ilosc = filter_var(intval($_GET['miecznikN']),
							FILTER_SANITIZE_NUMBER_INT);
				$wwiosce = DB::table('village_units')->select('number')
								->where('id_unit',2)
								->where('id_village',session('active_village')['id'])
								->first();
				if($resources->steel >= ($ilosc*$miecznik->cost_steel) &&
					$resources->wood >= ($ilosc*$miecznik->cost_wood)){
					DB::table('village_units')
						->where('id_unit',2)
						->where('id_village',session('active_village')['id'])
						->update([
							'number' => ($wwiosce->number + $ilosc),
							'available' => ($wwiosce->number + $ilosc)
						]);
					DB::table('villages')
						->where('id',session('active_village')['id'])
						->update([
							'steel' => ($resources->steel - $miecznik->cost_steel*$ilosc),
							'wood' => ($resources->wood - $miecznik->cost_wood*$ilosc)
						]);
				}
				else echo '<script type="text/JavaScript">
							alert("Za mało surowców");
						</script>';
			}
			
			if(isset($_GET['topornikB'])) {
				$ilosc = filter_var(intval($_GET['topornikN']),
							FILTER_SANITIZE_NUMBER_INT);
				$wwiosce = DB::table('village_units')->select('number')
								->where('id_unit',3)
								->where('id_village',session('active_village')['id'])
								->first();
				if($resources->steel >= ($ilosc*$topornik->cost_steel) &&
					$resources->wood >= ($ilosc*$topornik->cost_wood)){
					DB::table('village_units')
						->where('id_unit',3)
						->where('id_village',session('active_village')['id'])
						->update([
							'number' => ($wwiosce->number + $ilosc),
							'available' => ($wwiosce->number + $ilosc)
						]);
					DB::table('villages')
						->where('id',session('active_village')['id'])
						->update([
							'steel' => ($resources->steel - $topornik->cost_steel*$ilosc),
							'wood' => ($resources->wood - $topornik->cost_wood*$ilosc)
						]);
				}
				else echo '<script type="text/JavaScript">
							alert("Za mało surowców");
						</script>';
			}
			
			if(isset($_GET['rycerzB'])) {
				$ilosc = filter_var(intval($_GET['rycerzN']),
							FILTER_SANITIZE_NUMBER_INT);
				$wwiosce = DB::table('village_units')->select('number')
								->where('id_unit',4)
								->where('id_village',session('active_village')['id'])
								->first();
				if($resources->steel >= ($ilosc*$rycerz->cost_steel) &&
					$resources->wood >= ($ilosc*$rycerz->cost_wood)){
					DB::table('village_units')
						->where('id_unit',4)
						->where('id_village',session('active_village')['id'])
						->update([
							'number' => ($wwiosce->number + $ilosc),
							'available' => ($wwiosce->number + $ilosc)
						]);
					DB::table('villages')
						->where('id',session('active_village')['id'])
						->update([
							'steel' => ($resources->steel - $rycerz->cost_steel*$ilosc),
							'wood' => ($resources->wood - $rycerz->cost_wood*$ilosc)
						]);
				}
				else echo '<script type="text/JavaScript">
							alert("Za mało surowców");
						</script>';
			}
		?>
	
	</body>
	
</html>