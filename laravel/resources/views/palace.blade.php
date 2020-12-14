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
	
	@php
	$osadnik = DB::table('units')
					->select('name','cost_steel','cost_wood')
					->where('id',5)->first();
	$resources = DB::table('villages')->select('steel', 'wood', 'brick')->where('id', session('active_village')['id'])->first();
	$palace = DB::table('village_buildings as vb') 
							->join('buildings as b', 'vb.id_building', 'b.id')
							->select('vb.level as level')
							->where('vb.id_village', session('active_village')['id'])
							->where('name', 'pałac')
							->orderByDesc('vb.level')
							->first();
	@endphp
	
	<body>
	
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
					<h1 class="display-5"> Pałac poziom {{$palace->level}} </h1>
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
							<td> (osadnik) </td>
							<td> (hh:mm:ss) </td>
							<td> (hh:mm:ss) </td>
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
							<th> Rekrutuj </th>
						</tr>
						<tr>
							<td> {{$osadnik->name}} </td>
							<td> {{$osadnik->cost_steel}} stali, {{$osadnik->cost_wood}} drewna </td>
							<form method = "get">
								<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
								<td>
									<input type="number" class="form-control" id="osadnikN" name="osadnikN">
								</td>
								<td> <button type="submit"
											class="btn btn-primary"
											name="osadnikB"
											id="osadnikB">
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
			if(isset($_GET['osadnikB'])) {
				$ilosc = filter_var(intval($_GET['osadnikN']),
							FILTER_SANITIZE_NUMBER_INT);
				$wwiosce = DB::table('village_units')->select('number')
								->where('id_unit',1)
								->where('id_village',session('active_village')['id'])
								->first();
				if($resources->steel >= ($ilosc*$osadnik->cost_steel) &&
					$resources->wood >= ($ilosc*$osadnik->cost_wood)){
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
							'steel' => ($resources->steel - $osadnik->cost_steel*$ilosc),
							'wood' => ($resources->wood - $osadnik->cost_wood*$ilosc)
						]);
				}
				else echo '<script type="text/JavaScript">
							alert("Za mało surowców");
						</script>';
			}
		?>
		
	</body>
	
</html>