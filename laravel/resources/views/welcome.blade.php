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
        </style>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
			integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
			crossorigin="anonymous">
		
    </head>
	
    <body>
        
		<div class="container">
			<a href = "/admin">
				<img src="napis.png" alt="KingWars">
			</a>
		</div>
		
		<div class="container">
		
			<div class="row">
			
				<!-- Pusta kolumna z lewej -->
				<div class="col"> </div>
				
				<!-- Tutaj jest karuzela z przyciskami -->
				<div class="col-8" style="
					background: url('https://i.stack.imgur.com/7YKUD.jpg')
					no-repeat fixed center">
					
					<hr class="my-4">
					
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
										
												Zarejestruj się
											</button>
										</div>
										<div class="col-sm">
											<button class="btn btn-dark collapsed btn-block"
												type="button"
												data-toggle="collapse"
												data-target="#collapseTwo"
												aria-expanded="false"
												aria-controls="collapseTwo">
								
												Zaloguj się
											</button>
										</div>
									</div>
								</h5>
							</div>
							
							<!-- Tutaj są chowane formularze -->
							<div id="collapseOne"
								class="collapse show"
								aria-labelledby="headingOne"
								data-parent="#accordionExample">
								
								<div class="card-body">
								
									<!-- Formularz rejestracji -->
									<form action="/RegUser" method = "post">
									<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
										<div class="form-group">
											<label for="email1"> Adres e-mail </label>
											<input type="text"
												class="form-control"
												id="email1"
												name="email1"
												placeholder="Podaj e-mail">
										</div>
										<div class="form-group">
											<label for="login1"> Login </label>
											<input type="text"
												class="form-control"
												id="login1"
												name="login1"
												placeholder="Podaj login">
										</div>
										<div class="form-group">
											<label for="password1"> Hasło </label>
											<input type="password"
												class="form-control"
												id="password1"
												name="password1"
												placeholder="Podaj hasło">
										</div>
										<button type="submit" class="btn btn-dark"> Zarejestruj </button>
									</form>
									
								</div>
							</div>
						</div>
						<div class="card">
							<div id="collapseTwo"
								class="collapse"
								aria-labelledby="headingTwo"
								data-parent="#accordionExample">
								
								<div class="card-body">
								
									<!-- Formularz logowania -->
									<form action = "/LogUser" method = "post">
									<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
										<div class="form-group">
											<label for="LM1"> Nazwa użytkownika lub e-mail </label>
											<input type="login"
												class="form-control"
												id="LM1"
												name="LM1">
										</div>
										<div class="form-group">
											<label for="LP1"> Hasło </label>
											<input type="password"
												class="form-control"
												id="LP1"
												name="LP1">
										</div>
										<button type="submit" class="btn btn-dark"> Zaloguj </button>
									</form>
									
								</div>
							</div>
						</div>
					</div>
					
					<hr class="my-4">
					
					<!-- Tutaj są aktualności -->
					
					@foreach ($news as $update)
					
					<div class="alert alert-info" role="alert">
						<h5> {{ $update->date }} </h5>
						<hr class="my-1">
						{{ $update->content }}
					</div>
					
					@endforeach
					
				</div>
				
				<!-- Pusta kolumna z prawej -->
				<div class="col"> </div>
				
			</div>
			
		</div>
		
    </body>
	
</html>
