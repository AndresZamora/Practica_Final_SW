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
    <title>Gestión Altas/Bajas Socios</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>	
		function RefrescarTabla(){
			ObtenerSocios();
			setInterval(ObtenerSocios, 1000);
		}
	
		function ObtenerSocios() {
//			var operacion= "DarAlta";
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//					location.href="DarAltasBajasBD.php";
					document.getElementById("tabla").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","tablaSocios.php",true);
			xmlhttp.send();
		}
		
		function OperacionDarAlta(x){
			var email= x;
			var operacion= 'DarAlta';
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//					document.getElementById("comprobacion2").innerHTML = xmlhttp.responseText;
					ObtenerSocios();
				}
			}		
			xmlhttp.open("POST","AltasBajasBD.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("operacion="+operacion+"&email="+email);
		}
		
		function OperacionDarBaja(x){
			var email= x;
			var operacion= 'DarBaja';
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//					document.getElementById("comprobacion2").innerHTML = xmlhttp.responseText;
					ObtenerSocios();
				}
			}		
			xmlhttp.open("POST","AltasBajasBD.php",true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send("operacion="+operacion+"&email="+email);
		}
	
	</script>	
  </head>
  <body onload="ObtenerSocios()">
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
		  <li class="active">Gestión Altas/Bajas</li>
		</ol>
		
		<h3 style="text-align:center"><b>GESTION ALTAS/BAJAS SOCIOS</b></h3><br>		
		<div id="comprobacion2"></div></br>
		
		<div id="tabla" class='table-responsive'></div>

		
    </div> <!-- /container -->
  </body>
</html>