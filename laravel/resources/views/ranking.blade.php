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
            h1{
                text-align: center;
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
        $name=DB::select('select login from players where login=? or email=? ',
         [$user,$user]);

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
               
                 <!-- ranking -->
                 <li class="nav-item active">
                   <a class="nav-link" href="ranking">Ranking <span class="sr-only">(current)</span></a>
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
        <!-- panel z danymi -->

        <h1 style="padding-top: 30px"> Ranking graczy </h1> <br/>
        <div class="container">
			<div class="alert alert-secondary">
				<?php
					$i=1;
					$ranking = DB::select('select login, points
											from players
											order by points desc');
					foreach ($ranking as $mr) $middleman[] = $mr->login;
					$myplc = array_search($user, $middleman);
				?>
				<h4> Jesteś na miejscu: {{ $myplc+1 }} </h4>
			</div> <br/>
			@foreach ($ranking as $rank)
				@switch ($i)
					@case(1)
						<div class="alert alert-info" style="background-color: gold">
					@break
					@case(2)
						<div class="alert alert-info" style="background-color: silver">
					@break
					@case(3)
						<div class="alert alert-info" style="background-color: sandybrown">
					@break
					@default
						<div class="alert alert-info">
				@endswitch
				<h5> Miejsce {{ $i }} Punkty: {{ $rank->points }} </h5>
				<hr class="my-1">
				<h4> {{ $rank->login }} </h4>
			</div>
			@php $i++; @endphp
			@endforeach
		</div>
		
    </body>
	
</html>
