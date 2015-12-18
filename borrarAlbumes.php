<?php
	include ("seguridad.php");
	if($_SESSION['rol']!='Administrador'){
		header('location:index.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Borrar Fotos</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>
		function ObtenerTodasAlbumes() {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("tabla").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","verAlbumesTodos.php",true);
			xmlhttp.send();
		}
		
		function BorrarAlbumes(x){
			var idAlbum= x;
			var operacion= 'BorrarAlbum';
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {					
					if(xmlhttp.responseText.toString().search("EXITO")!=-1){
						ObtenerTodasAlbumes();
						document.getElementById("comprobacion2").innerHTML = "<div class='alert alert-success'><p style='text-align:center'><strong>EXITO!</strong> Se ha borrado el album.</p></div>";
					}else{
						document.getElementById("comprobacion2").innerHTML = "<div class='alert alert-danger'><strong>ERROR!</strong> ha ocurrido un error.</div>";
					}
				}
			}		
			xmlhttp.open("POST","borrarFotosAlbumesBD.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("operacion="+operacion+"&idAlbum="+idAlbum);
		}
	
	</script>	
  </head>
  <body onload="ObtenerTodasAlbumes()">
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
		  <li><a href="menu_Admin.php">Menu Administrador</a></li>
		  <li class="active">Borrar Albumes</li>
		</ol>
		
		<h3 style="text-align:center"><b>BORRAR ALBUMES</b></h3><br>		
		<div id="comprobacion2"></div></br>

		<div id="tabla" class='table-responsive'></div>
		
    </div> <!-- /container -->
  </body>
</html>