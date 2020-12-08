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
		
        <!-- FORMULARZE EDYCJI -->
        <div class="container profil">
			<div style="background-color:antiquewhite">
				<div class="container profil2">
					<h1 style="text-align: center"> Panel użytkownika </h1>
					<hr class="my-1">
					
					<h3> Zmień login </h3>
					<form method="get"> 
						<div class="input-group mb-4">
							<input type="text"
								class="form-control"
								placeholder="Nowy login"
								name="new_login"
								id="new_login">
							<div class="input-group-append">
								<input type="submit"
										name="edit_login"
										id="edit_login"
										class="btn btn-outline-secondary"
										value="Zmień" /> 
							</div>
						</div>
					</form>
					<hr class="my-1">
					
					<h3> Zmień adres e-mail </h3>
					<form method="get"> 
						<div class="input-group mb-4">
							<input type="text"
								class="form-control"
								placeholder="Nowy e-mail"
								name="new_email"
								id="new_email">
							<div class="input-group-append">
								<input type="submit"
										name="edit_email"
										id="edit_email"
										class="btn btn-outline-secondary"
										value="Zmień" /> 
							</div>
						</div>
					</form>
					<hr class="my-1">
					
					<h3> Zmień hasło </h3>
					<form method="get"> 
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"
										id="basic-addon1">
									Stare hasło
								</span>
							</div>
							<input type="password"
								class="form-control"
								name="old_pass"
								id="old_pass"
								aria-describedby="basic-addon1">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"
										id="basic-addon2">
									Nowe Hasło
								</span>
							</div>
							<input type="password"
								class="form-control"
								name="new_pass"
								id="new_pass"
								aria-describedby="basic-addon2">
							<div class="input-group-append">
								<input type="submit"
										name="edit_pass"
										id="edit_pass"
										class="btn btn-outline-secondary"
										value="Zmień" /> 
							</div>
						</div>
					</form>
					<hr class="my-1">
					
					<h3> Skasuj konto </h3>
					<form method="get"> 
						<div class="input-group mb-3">
							<input type="password"
								class="form-control"
								placeholder="Hasło"
								name="delete_pass"
								id="delete_pass">
							<div class="input-group-append">
								<input type="submit"
										name="delete_acc"
										id="delete_acc"
										class="btn btn-outline-danger"
										value="Usuń konto" /> 
							</div>
						</div>
					</form>
					<hr class="my-1">
					
				</div>
			</div>
        </div>
		
    </body>
	
	<!-- OKIENKA Z BŁĘDAMI -->
	<?php
        if(isset($_GET['edit_login'])) { 
			if( DB::table('players')
					->select('login')
					->where('login',
					filter_var(strval($_GET['new_login']), FILTER_SANITIZE_STRING))
					->first() == NULL ) {
				DB::table('players')
					->where('login', $name->login)
					->update(['login' => 
					filter_var(strval($_GET['new_login']), FILTER_SANITIZE_STRING)]);
				session()->put('data',['LM1' => 
					filter_var(strval($_GET['new_login']), FILTER_SANITIZE_STRING)]);
			}
            else echo '<script type="text/JavaScript">
							alert("Podana nazwa użytkownika już istnieje");
						</script>';
        }
		
		if(isset($_GET['edit_email'])) {
			if( DB::table('players')
					->select('email')
					->where('email',
					filter_var(strval($_GET['new_email']), FILTER_SANITIZE_EMAIL))
					->first() == NULL ) {
				DB::table('players')
					->where('login', $name->login)
					->update(['email' =>
					filter_var(strval($_GET['new_email']), FILTER_SANITIZE_EMAIL)]);
			}
            else echo '<script type="text/JavaScript">
							alert("Podany adres e-mail już istnieje");
						</script>';
        }
		
		if(isset($_GET['edit_pass'])) {
			if( DB::table('players')
					->select('password')
					->where('login', $name->login)
					->first()
					->password == hash('sha512',
					filter_var(strval($_GET['old_pass']), FILTER_SANITIZE_STRING))){
				DB::table('players')
					->where('login', $name->login)
					->update(['password' => hash('sha512',
					filter_var(strval($_GET['new_pass']), FILTER_SANITIZE_STRING))]);
			}
            else echo '<script type="text/JavaScript">
							alert("Podane hasło jest nieprawidłowe");
						</script>';
        }
		
		if(isset($_GET['delete_acc'])) {
			if( DB::table('players')
					->select('password')
					->where('login', $name->login)
					->first()
					->password == hash('sha512',
					filter_var(strval($_GET['delete_pass']), FILTER_SANITIZE_STRING))){
				DB::table('players')
					->where('login', $name->login)
					->delete();
				echo '<script> window.location = "/"; </script>';
			}
            else echo '<script type="text/JavaScript">
							alert("Podane hasło jest nieprawidłowe");
						</script>';
        } 
    ?> 
	
</html>
