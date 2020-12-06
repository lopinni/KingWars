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
	
    <body onload="alert('Niepoprawna nazwa użytkownika i/lub hasło');">
		
		<div class="container">
		
			<div class="jumbotron" style="background: url('https://i.stack.imgur.com/7YKUD.jpg')">
				
				<h1 class="display-4">
					<p style="color:#AEB404; font-family:'Impact'">
						Logowanie administracyjne </p>
				</h1>
				
				<div class="container" style="background-color:#ffffcc">
					<hr class="my-4">
					
					<form action = "/LogAdmin" method = "post">
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
					
					<hr class="my-4">
				</div>
			</div>
		</div>
	</body>
</html>