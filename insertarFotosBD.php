<?php
	include ("seguridad.php");
	if($_SESSION['rol']!='Socio'){
		header('location:index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver Fotos</title>
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
		  <li><a href="menu_socio.php">Menu Socio</a></li>
		  <li><a href="gestionAlbumes.php">Gestion Album</a></li>
		  <li><a href="insertarFotos.php">Añadir Foto</a></li>
		  <li class="active">Foto añadida</li>
		</ol>
		
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
//			session_start();
			
			//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
				//y que el tamano del archivo no exceda los 16mb
				$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
				$limite_kb = 16384; //16mb es el limite de medium blob
				 
				if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
				 
					//este es el archivo temporal
					$imagen_temporal  = $_FILES['imagen']['tmp_name'];  
					//este es el tipo de archivo
					$tipo = $_FILES['imagen']['type'];
					//leer el archivo temporal en binario
					$fp     = fopen($imagen_temporal, 'r+b');
					$data = fread($fp, filesize($imagen_temporal));
					fclose($fp);
					//escapar los caracteres
					$data= mysqli_real_escape_string ($enlace, $data);
					
					if (!mysqli_query($enlace,"INSERT INTO fotos(Id_Album,Imagen,Descripcion,Visibilidad) 
						VALUES('".$_SESSION['idAlbum']."','$data','".$_POST['descripcion']."','".$_POST['visibilidad']."')")) {						
						echo "
							<h3 style='text-align:center'><b>FOTO NO AÑADIDA CORRECTAMENTE</b></h3><br>		
							<div id='comprobacion2'></div></br>
							<div class='col-sm-6 col-md-3'>
								<div class='thumbnail'>
									<img src='images/error.jpg' alt='LogoIncorrecto' class='img-responsive'>
									</div>
							</div>";
						
					}else{
						echo "
							<h3 style='text-align:center'><b>FOTO AÑADIDA CORRECTAMENTE</b></h3><br>		
							<div id='comprobacion2'></div></br>
							<div class='col-sm-6 col-md-12'>
								<div class='thumbnail'>
									<img src='images/correcto.jpg' alt='LogoCorrecto' class='img-responsive'>
								</div>
							</div>
							";
					}	
				} else {
					echo "<h2>ERROR: Falló en la inserción en la tabla, archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes</h2>";
				}
		?>
		
		
    </div> <!-- /container -->
  </body>
</html>

