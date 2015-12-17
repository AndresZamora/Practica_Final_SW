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
	
	<script>
		function CrearAlbum() {
			var nombre=document.getElementById("name").value;
			if((nombre!="")){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						if(xmlhttp.responseText.toString().search("EXITO")!=-1){
							document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b><font color=green>Creado el Album con EXITO</font></b></p>";
						}else{
							document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b><font color=red>ERROR al crear el Album</font></b></p>";
						}
					}
				}		
				xmlhttp.open("POST","crearAlbumBD.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("nombre="+nombre);
			}else{
				document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b>Rellenar los campos obligatorios</b></p>";
			}
		}
		
		function OperacionInsertar(x){
			var idAlbum= x;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					location.href="insertarFotos.php";
				}
			}		
			xmlhttp.open("POST","crearIdAlbum.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("idAlbum="+idAlbum);
			
//			document.getElementById("comprobacion2").innerHTML = x;
		}
	
	</script>	
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
		  <li class="active">Ver Fotos</li>
		</ol>
		
		<h3 style="text-align:center"><b>VER FOTOS</b></h3><br>		
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
			
			$resultado = $enlace->query("SELECT * FROM fotos WHERE Id_Album = '".$_SESSION['idAlbum']."'");
	
			for ($num_fila = 0; $num_fila <= $resultado->num_rows - 1; $num_fila++) {
				$resultado->data_seek($num_fila);
				$fila = $resultado->fetch_assoc();		
				echo("
					<div class='col-sm-6 col-md-3'>
					<div class='thumbnail'>
						<img src='data:image/;base64,".base64_encode($fila['Imagen'])."' width='304' height='236'>
<!--					<img src='images/carpeta.png' alt='Album'>-->
					<div class='caption'>
						<p><b>ALBUM ".$fila['Id_Album']."</b></p>
						<p><b>FOTO ".$fila['ID']."</b></p>
						<p><b>Descripcion:</b> ".$fila['Descripcion']."</p>
						<p><a href='#' class='btn btn-primary' role='button'>Ver Completa</a>
						<button type='button' class='btn btn-default' role='button' onclick='OperacionInsertar(".$fila['ID'].")'>Etiquetar</button></p>
					</div></div></div>
					");
			}		
			
			mysqli_close($enlace);
		?>
		
		
    </div> <!-- /container -->
  </body>
</html>