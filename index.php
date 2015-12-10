<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio PicBox</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
	<?php
		session_start();
		include ("cabecera.php");
	?>

	
	<div class="jumbotron" style="background-image: url('images/header.jpg');>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 style="text-align:center"><b>PICBOX</b></h1>
					<h2 style="text-align:center"><i>"Tus fotos siempre contigo"</i></h2>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div id="main">
<!--			<div id="content">
				<span><a href='menu_socio.html'>Menu Socio</a></span>
				<span><a href='crearAlbum.php'>Crear Album</a></span>
			</div>-->
			
			<?php
				if (!isset($_SESSION['conectado'])){
						echo ("							
							<h3>Inicio</h3>
						");
				}else{
					if($_SESSION['rol']=='Socio'){
						include ("menu_socio.php");
					}else if($_SESSION['rol']=='Administrador'){
						echo ("
							<span class='right'><p>Usuario Profesor: '".$_SESSION['usuarioactual']."'</p></span>
							<span class='right'><a href='cerrar.php'>Logout</a></span>
						");
					}
				}
			
			
			?>
			

		</div>
    </div> <!-- /container -->
	
	<footer>
		<p>2015-2016</p>
	</footer>

  </body>
</html>