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
				width: 10%;
				height: auto;
				padding-top: 1px;
				padding-bottom: 1px;
				padding-left: 1px;
				padding-right: 1px;
			}
			.profil { padding-top: 30px; }
			.profil2 {
				padding-top: 10px;
				padding-bottom: 10px;
				padding-left: 10px;
				padding-right: 10px;
			}
			h1 { padding-bottom: 30px; }
			.kontener {
  position: relative;
  width: 100%;
}

/* Make the image responsive */
.kontener img {
  width: 100%;
  height: auto;
}

/* Style the button and place it in the middle of the container/image */
.kontener .przycisk {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
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
			$name=DB::select('select login from players where login=? or email=? ',[$user,$user]);
        @endphp

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">

             <a class="navbar-brand"> Gracz {{$user}} </a>
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
               <!-- obecne -->
                

                 <!-- link -->
                 <li class="nav-item">
                   <a class="nav-link" href="profile">Profil</a>
                 </li>

                 <!-- link -->
                 <li class="nav-item">
                   <a class="nav-link" href="logout">Wyloguj się</a>
                 </li>
                 
               </ul>
             </div>
            </nav>
        </header>
		
		<div class="container profil">
			<div style="background-color:wheat">
				<div class="container profil2">
					<h1 style="text-align:center;"> Wybierz kierunek wioski </h1>
					
					<div class="row align-items-start">
						<div class="col">
							<div class="text-right">
								<button type="button" class="btn btn-success"> Północny zachód </button>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<img src="N.png">
							</div>
						</div>
						<div class="col">
							<button type="button" class="btn btn-success"> Północny wschód </button>
						</div>
					</div>
					<div class="row align-items-center">
						<div class="col">
							<div class="text-right">
								<img src="W.png">
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<div class="kontener">
									<img src="kompas.png" style="width:300px;height:300px;">
									<button type="button" class="btn btn-success przycisk"> LOSOWY </button>
								</div>
							</div>
						</div>
						<div class="col">
							<img src="E.png">
						</div>
					</div>
					<div class="row align-items-end" style="padding-bottom:30px;">
						<div class="col">
							<div class="text-right">
								<button type="button" class="btn btn-success"> Południowy zachód </button>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<img src="S.png">
							</div>
						</div>
						<div class="col">
							<button type="button" class="btn btn-success"> Południowy wschód </button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
    </body>
	
</html>
