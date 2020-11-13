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
				padding-top: 30px;
				padding-bottom: 30px;
				padding-left: 130px;
				padding-right: 130px;
			}
			.profil { padding-top: 30px; }
			.profil2 {
				padding-top: 10px;
				padding-bottom: 10px;
				padding-left: 10px;
				padding-right: 10px;
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
				<span class="navbar-toggler-icon"></span>
            </button>
            
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="ranking">Ranking </a>
						</li>
						<!-- wioska -->
						<li class="nav-item">
							<a class="nav-link" href="village_view">Wioska </a>
						</li>
						<!-- link -->
						<li class="nav-item">
							<a class="nav-link" href="map_view">Mapa</a>
						</li>
						<!-- link -->
						<li class="nav-item active">
							<a class="nav-link disabled" href="profile">
								Profil <span class="sr-only"> (current) </span>
							</a>
						</li>
						<!-- link -->
						<li class="nav-item">
							<a class="nav-link" href="logout">Wyloguj się</a>
						</li>
					</ul>
				</div>
            </nav>
        </header>
        <!-- panel z danymi -->

        <div class="container profil">
			<div style="background-color:#ffffff">
				<div class="container profil2">
					<h1 style="text-align: center"> Panel użytkownika </h1>
					<hr class="my-1">
					<ul class="nav justify-content-center">
						<li class="nav-item">
							<a class="nav-link active" href="#"> Zmień login </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"> Zmień adres e-mail </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"> Zmień hasło </a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#"> Skasuj konto </a>
						</li>
					</ul>
				</div>
			</div>
        </div>
		
    </body>
	
</html>
