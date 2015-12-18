<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mostrar Fotos</title>
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
		<ol class="breadcrumb">
		<?php
		
		if (!isset($_SESSION['conectado'])){
			echo("<li><a href='index.php'>Inicio</a></li>");
		}else{
			if($_SESSION['rol']=='Socio'){
				echo("<li><a href='menu_socio.php'>Menu Socio</a></li>");
			}else if($_SESSION['rol']=='Administrador'){
				echo("<li><a href='menu_admin.php'>Menu Administrador</a></li>");
			}
		}
		?>
		  <li class="active">Mostrar Fotos</li>
		</ol>
		
		<h3 style="text-align:center"><b>MOSTRAR FOTOS</b></h3><br>		
		<div id="comprobacion2"></div></br>
		
		<?php	
			$enlace = mysqli_connect("localhost", "root", "", "picbox");   //Conexion con la base de datos en local.
		//	$enlace = mysqli_connect("mysql.hostinger.es", "u465939494_root", "quizes", "u465939494_quiz");		// Conexión con la base de datos en Hostinger.
			
			mysqli_set_charset($enlace, "utf8");

			if (!$enlace) {
				echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
				echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
				echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
				exit;
			}
			
//			$resultado = $enlace->query("SELECT * FROM fotos");
			
			if (!isset($_SESSION['conectado'])){
				$resultado = $enlace->query("SELECT * FROM fotos WHERE Visibilidad='publica'");
			}else{
				if($_SESSION['rol']=='Socio'){					
					$resultado = $enlace->query("
										SELECT *
										FROM album
										INNER JOIN fotos
										ON album.ID=fotos.Id_Album										
										WHERE fotos.Visibilidad='publica' OR fotos.Visibilidad='accesoLimitado'
										OR (album.Email='".$_SESSION['usuarioactual']."' AND fotos.Visibilidad='privada')");
					
				}else if($_SESSION['rol']=='Administrador'){
					$resultado = $enlace->query("SELECT * FROM fotos");
				}
			}
			
			echo("
				<table class='table'>
					<tr class='success'>
						<td><b>Numero</b></td>
						<td><b>Descripcion</b></td>
						<td><b>Visibilidad</b></td>
						<td><b>Imagen</b></td>
					</tr>");	
			for ($num_fila = 0; $num_fila <= $resultado->num_rows - 1; $num_fila++) {
				$resultado->data_seek($num_fila);
				$fila = $resultado->fetch_assoc();
				echo("
					<tr>
						<td><b>".$num_fila."</b></td>		
						<td>".$fila['Descripcion']."</td>
						<td>".$fila['Visibilidad']."</td>
						<td>
						<div class='thumbnail'>
							<img src='data:image/;base64,".base64_encode($fila['Imagen'])."' width='300' height='300'>
						</div>
						</td>
					");
			}
			echo("</table>");
			
			mysqli_close($enlace);
		?>
		
		
    </div> <!-- /container -->
  </body>
</html>