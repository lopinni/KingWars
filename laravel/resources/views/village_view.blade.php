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
			.col-md-8, .col-md-4 {
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
		
		<!-- navbar -->
		@php
		$user= session('data')['LM1'];
        $name=DB::table('players')->select('id','login')->where('login', $user)->orWhere('email', $user)->first();
		 
		
        @endphp

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">

             <a class="navbar-brand"> Gracz {{$name->login}} </a>
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
			
        </header>
		
		<div class="container">
			<div class="row">
			
				<!-- Budynki -->
				<div class="col-md-8">
				
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src=".../100px180/" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Ratusz </h5>
									<p class="card-text"> Jakiś tekst może. </p>
									<a href="#" class="btn btn-primary"> Przejdź </a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src=".../100px180/" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Kopalnia cegieł </h5>
									<p class="card-text"> Jakiś tekst może. </p>
									<a href="#" class="btn btn-primary"> Przejdź </a>
								</div>
							</div>
						</div>
					</div>
					
					<hr class="my-4">
					
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src=".../100px180/" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Koszary </h5>
									<p class="card-text"> Jakiś tekst może. </p>
									<a href="#" class="btn btn-primary"> Przejdź </a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src=".../100px180/" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Kopalnia stali </h5>
									<p class="card-text"> Jakiś tekst może. </p>
									<a href="#" class="btn btn-primary"> Przejdź </a>
								</div>
							</div>
						</div>
					</div>
					
					<hr class="my-4">
					
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src=".../100px180/" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Pałac </h5>
									<p class="card-text"> Jakiś tekst może. </p>
									<a href="#" class="btn btn-primary"> Przejdź </a>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<img class="card-img-top" src=".../100px180/" alt="Zdjęcie budynku">
								<div class="card-body">
									<h5 class="card-title"> Kopalnia drewna </h5>
									<p class="card-text"> Jakiś tekst może. </p>
									<a href="#" class="btn btn-primary"> Przejdź </a>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
				<!-- To z boku -->
				<div class="col-md-4">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"> Jednostki </h5>
							<p class="card-text"> Tu będą jednostki gracza. </p>
							<h5 class="card-title"> Aktualności </h5>
							<p class="card-text"> Tu będą aktualności. </p>
						</div>
					</div>
				</div>
				
			</div>
		</div>

    </body>
	
</html>
