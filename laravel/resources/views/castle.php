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
	
		<div class="container" style="padding-top:30px;">
			<div class="container" style="background-color:wheat">
				<div class="container" style="padding-top:10px;">
					<div class="container" style="background-color:lightgrey;">
						<h4 class="text-center"> Surowce: (drewno)X, (stal)X, (cegła)X </p>
					</div>
				</div>
				<div class="jumbotron" style="background-color:wheat">
					<h1 class="display-5"> Siedziba główna wioski (poziom X) </h1>
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
					</table>
					<hr class="my-4">
					<h3> Konstrukcja </h3>
					<table style="width:100%; background-color:lightgrey;">
						<tr>
							<th> Budynki </th>
							<th> Wymagania </th>
							<th> Czas konstrukcji </th>
							<th> Konstruuj </th>
						</tr>
						<tr>
							<td> (budynek, poziom) </td>
							<td> (drewno)X, (stal)X, (cegła)X </td>
							<td> (hh:mm::ss) </td>
							<td> (przycisk/link konstruuj) </td>
						</tr>
					</table> 
				</div>
			</div>
		</div>
	
	</body>
	
</html>