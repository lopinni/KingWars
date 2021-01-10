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
        $av = session('active_village')['id'];
        $uname=DB::table('players')->select('id','login')->where('login', $user)->orWhere('email', $user)->first();
		
		$active_v = session('active_village')['id'];
		
			#lista wiosek użytkownika
		$village_list = DB::table('villages')->select('id','name','x_coordinate','y_coordinate')->where('id_player', $uname->id)->orderBy('name')->get();

        @endphp

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: wheat;">

             <a class="navbar-brand"> Gracz {{$uname->login}} </a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
             </button>
            
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
			   <li class="nav-item">
                   <a class="nav-link" href="ranking">Ranking </a>
                 </li>
               <!-- obecne -->
                 <li class="nav-item">
                   <a class="nav-link" href="village_view">Wioska </a>
                 </li>
                 <!-- link -->
                 <li class="nav-item active">
                   <a class="nav-link disabled" href="map_view">Mapa<span class="sr-only">(current)</span></a>
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
			
			<!-- Nowy kod -->
			<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(167, 172, 120, 0.473);">
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						
							
							@foreach ($village_list as $vlist)

								
								
								<li class=nav-link><a classnav-lin href="/map_view/{{$vlist->id}}">{{$vlist->name}}</a>  </li>
							
							@endforeach
					</ul>
				</div>
            </nav>
        </header>
        <?php

				$tgt_id = session()->get('village_inspect')['id'];
				$tgt_data = DB::table('villages')->select('name')
                    ->where('id', $tgt_id)->first();

                $av_pikes = DB::table('village_units')->select('number')->where('id_village', $av)->where('id_unit', 1)->first();
                $av_swords = DB::table('village_units')->select('number')->where('id_village', $av)->where('id_unit', 2)->first();
                $av_axes = DB::table('village_units')->select('number')->where('id_village', $av)->where('id_unit', 3)->first();
                $av_knights  = DB::table('village_units')->select('number')->where('id_village', $av)->where('id_unit', 4)->first();
                ?>


        <div class="container profil">
			<div style="background-color:antiquewhite">
				<div class="container profil2">
            <div class="container text-center"><h4>Atakujesz wioskę {{$tgt_data->name}}. </h4> </div>
            <div class="container text-center padding-top: 20px">
                <h5>wybierz, które jednostki wysyłasz do ataku.
				<hr class="my-1">
                <div class="container padding-top: 20px"></div>
                <form action = "/attack" method = "post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <label for="pikinier"> Ilość pikinierów (max. {{$av_pikes->number}}</label>
                        <input type="number" max="{{$av_pikes->number}}"
                            class="form-control"
                            id="pikinier"
                            name="pikinier">
                    </div>
                    <div class="form-group">
                        <label for="miecznik"> Ilość mieczników (max. {{$av_swords->number}}</label>
                        <input type="number" max="{{$av_swords->number}}"
                            class="form-control"
                            id="miecznik"
                            name="miecznik">
                    </div>
                    <div class="form-group">
                        <label for="topornik"> Ilość toporników (max. {{$av_axes->number}}</label>
                        <input type="number" max="{{$av_axes->number}}"
                            class="form-control"
                            id="topornik"
                            name="topornik">
                    </div>
                    <div class="form-group">
                        <label for="rycerz"> Ilość rycerzy (max. {{$av_knights->number}}</label>
                        <input type="number" max="{{$av_knights->number}}"
                            class="form-control"
                            id="rycerz"
                            name="rycerz">
                    </div>
                <button type="submit"
                    class="btn btn-dark text-center">
                    Zaatakuj
                </button>
                </form>
            </div>
        </div> </div> </div>
		

    </body>
	
</html>
