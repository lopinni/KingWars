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
        $uname=DB::table('players')->select('id','login')->where('login', $user)->orWhere('email', $user)->first();
		
		$active_v = session('active_village')['id'];
		
			#lista wiosek użytkownika
		$village_list = DB::table('villages')->select('id','name')->where('id_player', $uname->id)->orderBy('name')->get();

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
                   <a class="nav-link" href="map_view">Mapa<span class="sr-only">(current)</span></a>
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
		
		<div class="container profil">
			<div style="background-color:antiquewhite">
				<div class="container profil2">
				
				<?php
				$tgt_id = session()->get('village_inspect')['id'];
				$tgt_data = DB::table('villages as v')->join('players as p', 'v.id_player', 'p.id')
					->select('v.name as vname', 'v.x_coordinate as x', 'v.y_coordinate as y', 'v.points as points', 'p.login as pname')
					->where('v.id', $tgt_id)->first();
					
				?>
				
					<div class="container text-center"><h4> {{$tgt_data->vname}}. </h4> </div>
					<div class="container text-center">
						<div class="container padding-top: 20px "> Lokacja na mapie: {{$tgt_data->x}}, {{$tgt_data->y}}.</div>
						<a href=/attack_form><button type="button"
							class="btn btn-dark">
							zaatakuj
						</button></a>
					</div>
					<hr class="my-1">
					<div class="container msg">
					<form action = "/MsgSnd" method = "post">
						<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
					<br/>
					<div class="form-group">
						<label for="msg"> Wyślij wiadomość </label>
						<input type="text"
							class="form-control"
							placeholder="temat wiadomości"
							id="mst"
							name="mst">
							<input type="text"
							class="form-control"
							placeholder="treść wiadomości"
							id="msg"
							name="msg">
							<button type="button"
							class="btn btn-warning"
							data-toggle="modal"
							data-target="#modal">
							Wyślij
							</button>
							<div class="modal fade"
							id="modal"
							tabindex="-1"
							role="dialog"
							aria-labelledby="exampleModalLabel"
							aria-hidden="true">
							
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"
											id="exampleModalLabel">
										Wiadomość </h5>
									<button type="button"
											class="close"
											data-dismiss="modal"
											aria-label="Close">
										<span aria-hidden="true"> &times; </span>
									</button>
								</div>
								<div class="modal-body">
									Cy na pewno chcesz wysłać wiadomość?
								</div>
								<div class="modal-footer">
									<button type="button"
									class="btn btn-secondary"
									data-dismiss="modal">
									Anuluj
									<button type="submit" class="btn btn-dark">
										Ok
									</button>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
				</div>


		</div>

    </body>
	
</html>
