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
			.right { float: right; }
        </style>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
			integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
			crossorigin="anonymous">
		
    </head>
	
    <body>
		
		<div class="container">
		
			<div class="jumbotron" style="background: url('https://i.stack.imgur.com/7YKUD.jpg')">
				
				<h1 class="display-4">
					<p style="color:#AEB404; font-family:'Impact'">
						Panel administracyjny </p>
				</h1>
		
				<!-- Tutaj jest karuzela z przyciskami -->
					<div class="accordion" id="accordionExample">
						<div class="card">
							<div class="card-header" id="headingOne" style="background-color:#000000">
								<h5 class="mb-0">
									<div class="row">
										<div class="col-sm">
											<button class="btn btn-dark btn-block"
												type="button"
												data-toggle="collapse"
												data-target="#collapseOne"
												aria-expanded="true"
												aria-controls="collapseOne">
										
												Dodaj aktualność
											</button>
										</div>
										<div class="col-sm">
											<button class="btn btn-dark collapsed btn-block"
												type="button"
												data-toggle="collapse"
												data-target="#collapseTwo"
												aria-expanded="false"
												aria-controls="collapseTwo">
								
												Zmień koszt rekrutacji
											</button>
										</div>
										<div class="col-sm">
											<button class="btn btn-dark collapsed btn-block"
												type="button"
												data-toggle="collapse"
												data-target="#collapseThree"
												aria-expanded="false"
												aria-controls="collapseThree">
								
												Zmień koszt budowy
											</button>
										</div>
										<div class="col-sm">
											<button class="btn btn-dark collapsed btn-block"
												type="button"
												data-toggle="collapse"
												data-target="#collapseFour"
												aria-expanded="false"
												aria-controls="collapseFour">
								
												Skasuj gracza
											</button>
										</div>
									</div>
								</h5>
							</div>
							
							<!-- Tutaj są chowane formularze -->
							<div id="collapseOne"
								class="collapse"
								aria-labelledby="headingOne"
								data-parent="#accordionExample">
								
								<div class="card-body">
								
									<!-- Aktualność -->
									<form action = "/PostNews" method = "post">
										<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
										<div class="form-row">
											<div class="col-md-4 mb-3">
												<div class="form-group">
													<label for="date1"> Data </label>
													<input type="date"
														class="form-control"
														id="date1"
														name="date1">
												</div>
												<button type="button"
														class="btn btn-dark"
														data-toggle="modal"
														data-target="#modal1">
													Dodaj
												</button>
												
												<!-- Okienko -->
												<div class="modal fade"
														id="modal1"
														tabindex="-1"
														role="dialog"
														aria-labelledby="exampleModalLabel"
														aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title"
																		id="exampleModalLabel">
																	Zatwierdź zmiany </h5>
																<button type="button"
																		class="close"
																		data-dismiss="modal"
																		aria-label="Close">
																	<span aria-hidden="true"> &times; </span>
																</button>
															</div>
															<div class="modal-body">
																Czy na pewno chcesz zapisać zmiany?
															</div>
															<div class="modal-footer">
																<button type="button"
																		class="btn btn-secondary"
																		data-dismiss="modal">
																	Anuluj
																</button>
																<button type="submit" class="btn btn-dark">
																	Zatwierdź zmiany
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-8 mb-6">
												<div class="form-group">
													<label for="TA1"> Treść </label>
													<textarea
														class="form-control"
														id="TA1"
														name="TA1"
														rows="3">
													</textarea>
												</div>
											</div>
										</div>
									</form>
									
									@php
								$news = DB::select('select date, content from news order by id desc');
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
						
						<div class="card">
							<div id="collapseTwo"
								class="collapse"
								aria-labelledby="headingTwo"
								data-parent="#accordionExample">
								
								<div class="card-body">
								
									<!-- Zmiana kosztu rekrutacji -->
									<form action = "/CostUnits" method = "post">
										<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
										<div class="form-group">
											<div class="form-row">
												<div class="col-md-4 mb-3">
													<label for="select1"> Wybierz typ jednostki </label>
													<select class="form-control" id="select1" name="select1">
													
														@php
													$units = DB::select('select name, cost_steel, cost_wood from units');
														@endphp
										
														@foreach ($units as $update)
														<option> {{ $update->name }} </option>
														@endforeach
											
													</select>
												</div>
												<div class="col-md-3 mb-2">
													<label for="costS"> Koszt stali </label>
													<input type="number" class="form-control" id="costS" name="costS">
												</div>
												<div class="col-md-3 mb-2">
													<label for="costW"> Koszt drewna </label>
													<input type="number" class="form-control" id="costW" name="costW">
												</div>
												<div class="col-md-2 mb-1">
													<hr class="my-3">
													<button type="button"
															class="btn btn-warning"
															data-toggle="modal"
															data-target="#modal2">
														Zmień
													</button>
												
													<!-- Okienko -->
													<div class="modal fade"
															id="modal2"
															tabindex="-1"
															role="dialog"
															aria-labelledby="exampleModalLabel"
															aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title"
																			id="exampleModalLabel">
																		Zatwierdź zmiany </h5>
																	<button type="button"
																			class="close"
																			data-dismiss="modal"
																			aria-label="Close">
																		<span aria-hidden="true"> &times; </span>
																	</button>
																</div>
																<div class="modal-body">
																	Czy na pewno chcesz zapisać zmiany?
																</div>
																<div class="modal-footer">
																	<button type="button"
																			class="btn btn-secondary"
																			data-dismiss="modal">
																		Anuluj
																	</button>
																	<button type="submit" class="btn btn-dark">
																		Zatwierdź zmiany
																	</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
									
									<!-- Lista jednostek -->
									<table style="width:100%">
										<tr>
											<th> Nazwa jednostki </th>
											<th> Koszt stali </th> 
											<th> Koszt drewna </th>
										</tr>
										
										@foreach ($units as $update)
										<tr>
											<td> {{ $update->name }} </td>
											<td> {{ $update->cost_steel }} </td>
											<td> {{ $update->cost_wood }} </td>
										</tr>
										@endforeach
										
									</table>
									
								</div>
							</div>
						</div>
						
						<div class="card">
							<div id="collapseThree"
								class="collapse"
								aria-labelledby="headingThree"
								data-parent="#accordionExample">
								
								<div class="card-body">
								
									<!-- Zmiana kosztu budowy -->
									<form action = "/CostBuildings" method = "post">
										<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
										<div class="form-group">
											<div class="form-row">
												<div class="col-md-4 mb-3">
													<label for="select2"> Wpisz typ budynku </label>
													<select class="form-control" id="select2" name="select2">
													
														@php
														$buildnames = DB::select('select distinct name from buildings');
														@endphp
										
														@foreach ($buildnames as $update)
														<option> {{ $update->name }} </option>
														@endforeach
													
													</select>
												</div>
												<div class="col-md-2 mb-1">
													<label for="costB2"> Wybierz poziom </label>
													<input type="number" class="form-control" id="select3" name="select3">
												</div>
												<div class="col-md-2 mb-1">
													<label for="costB2"> Koszt cegły </label>
													<input type="number" class="form-control" id="costB2" name="costB2">
												</div>
												<div class="col-md-2 mb-1">
													<label for="costW2"> Koszt drewna </label>
													<input type="number" class="form-control" id="costW2" name="costW2">
												</div>
												<div class="col-md-2 mb-1">
													<hr class="my-3">
													<button type="button"
														class="btn btn-warning"
														data-toggle="modal"
														data-target="#modal3">
													Zmień
												</button>
												
												<!-- Okienko -->
												<div class="modal fade"
														id="modal3"
														tabindex="-1"
														role="dialog"
														aria-labelledby="exampleModalLabel"
														aria-hidden="true">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title"
																		id="exampleModalLabel">
																	Zatwierdź zmiany </h5>
																<button type="button"
																		class="close"
																		data-dismiss="modal"
																		aria-label="Close">
																	<span aria-hidden="true"> &times; </span>
																</button>
															</div>
															<div class="modal-body">
																Czy na pewno chcesz zapisać zmiany?
															</div>
															<div class="modal-footer">
																<button type="button"
																		class="btn btn-secondary"
																		data-dismiss="modal">
																	Anuluj
																</button>
																<button type="submit" class="btn btn-dark">
																	Zatwierdź zmiany
																</button>
															</div>
														</div>
													</div>
												</div>
												</div>
											</div>
										</div>
									</form>
									
									<!-- Lista budynków -->
									<table style="width:100%">
										<tr>
											<th> Nazwa budynku </th>
											<th> Poziom rozbudowy </th>
											<th> Koszt cegły </th> 
											<th> Koszt drewna </th>
										</tr>
										
										@php
									$buildings = DB::select('select name, level, cost_brick, cost_wood from buildings');
										@endphp
										
										@foreach ($buildings as $update)
										<tr>
											<td> {{ $update->name }} </td>
											<td> {{ $update->level }} </td>
											<td> {{ $update->cost_brick }} </td>
											<td> {{ $update->cost_wood }} </td>
										</tr>
										@endforeach
										
									</table>
									
								</div>
							</div>
						</div>
						
						<div class="card">
							<div id="collapseFour"
								class="collapse"
								aria-labelledby="headingFour"
								data-parent="#accordionExample">
								
								<div class="card-body">
								
									<!-- Kasacja konta gracza -->
									@php
								$players = DB::select('select id, login, points from players');
									@endphp
									
									@foreach ($players as $delete)
									<div class="alert alert-danger" role="alert">
										<table style="width:100%">
										<tr>
											<td> Gracz: <b> {{ $delete->login }} </b> </td>
											<td> Punkty: <b> {{ $delete->points }} </b> </td>
											<td>
												<form action = "/DeletePlayer" method = "post">
													<input type = "hidden"
															name = "_token"
															value = "<?php echo csrf_token(); ?>">
													<input type = "hidden"
															name = "idPlayer"
															value = "<?php echo($delete->id); ?>">
													<button type="button"
															class="btn btn-danger"
															data-toggle="modal"
															data-target="#delete<?php echo($delete->id); ?>">
														Skasuj
													</button>
												
													<!-- Okienko -->
													<div class="modal fade"
															id="delete<?php echo($delete->id); ?>"
															tabindex="-1"
															role="dialog"
															aria-labelledby="exampleModalLabel"
															aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title"
																			id="exampleModalLabel">
																		Zatwierdź zmiany </h5>
																	<button type="button"
																			class="close"
																			data-dismiss="modal"
																			aria-label="Close">
																		<span aria-hidden="true"> &times; </span>
																	</button>
																</div>
																<div class="modal-body">
																	Czy na pewno chcesz zapisać zmiany?
																</div>
																<div class="modal-footer">
																	<button type="button"
																			class="btn btn-secondary"
																			data-dismiss="modal">
																		Anuluj
																	</button>
																	<button type="submit" class="btn btn-dark">
																		Zatwierdź zmiany
																	</button>
																</div>
															</div>
														</div>
													</div>
												</form>
											</td>
										</table>
									</div>
									@endforeach
									
								</div>
							</div>
						</div>
					</div>
					
					<hr class="my-1">
					<button type="button"
							class="btn btn-info right"
							onclick="window.location='{{ url("/") }}'">
						Wyloguj się
					</button>
				
			</div>
		</div>
		
    </body>
	
</html>
