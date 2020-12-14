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
				padding-top: 1px;
				padding-bottom: 1px;
				padding-left: 1px;
				padding-right: 1px;
			}
			.mapa { padding-top: 30px; }
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

								@if ($vlist->id == session()->get('active_village')['id'])
									<li class="nav-item">{{$vlist->name}}</li>

								@else
								
								<li class=nav-link><a classnav-lin href="/map_view/{{$vlist->id}}">{{$vlist->name}}</a>  </li>
									
								@endif
							
							@endforeach
					</ul>
				</div>
            </nav>
        </header>
		
		<div class="container mapa">
			<div style="background-color:#000000">
				
				<?php
					$my_coords = DB::table('villages')
										->select('x_coordinate', 'y_coordinate')
										->where('id', $active_v)
										->first();

					$y_coor = DB::select('select y_coordinate
											from villages
											order by id');
					$x_coor = DB::select('select x_coordinate
											from villages
											order by id');
											
					foreach ($x_coor as $x) $xarr[] = $x->x_coordinate;
					foreach ($y_coor as $y) $yarr[] = $y->y_coordinate;
					foreach ($village_list as $my) {
						$mxarr[] = $my->x_coordinate;
						$myarr[] = $my->y_coordinate;
					}
					$border_size=7;
					$map_size=100;

					if	($my_coords->x_coordinate <= $border_size)
						$x_pointer = 1;
					else if	($my_coords->x_coordinate >= $map_size-$border_size)
						$x_pointer = $map_size-($border_size*2)-1;
					else 
						$x_pointer = $my_coords->x_coordinate-7;
					
					if($my_coords->y_coordinate <= $border_size)
						$y_pointer = 1;
					else if($my_coords->y_coordinate >= $map_size-$border_size)
						$y_pointer = $map_size-($border_size*2)-1;
					else 
						$y_pointer = $my_coords->y_coordinate-7;

					echo('<table>');
						for ($j=$y_pointer; $j<=$y_pointer+2*$border_size; $j++){ 
							echo('<tr>');
							for ($i=$x_pointer; $i<=$x_pointer+2*$border_size; $i++){
								echo('<td>');
								if((in_array($i,$xarr) && $j == $yarr[array_search($i,$xarr)]) ||
									(in_array($j,$yarr) && $i == $xarr[array_search($j,$yarr)])){
										if ((in_array($i,$mxarr) && $j == $myarr[array_search($i,$mxarr)]) || (in_array($j,$myarr) && $i == $mxarr[array_search($j,$myarr)])){
											$my_href = DB::table('villages')
															->select('id')
															->where('y_coordinate', $j)
															->where('x_coordinate', $i)
															->first();
											echo '<a href="village_view/',$my_href->id,'">
													<img src="moja_wioska_80x80.png"> </a>';
											}
										else{
												$ref_id = DB::table('villages')
															->select('id')
															->where('y_coordinate', $j)
															->where('x_coordinate', $i)
															->first();
											echo '<a href="village_inspect/',$ref_id->id,'">
													<img src="wioska_80x80.png"> </a>';

											}
										}
								else
								 	echo('<a href="/new_village"><img src="puste_80x80.png"></a>');
							echo('</td>');
						}
						echo('</tr>');
					}
					echo('</table>');
						
				?>
				
			</div>
		</div>

    </body>
	
</html>
