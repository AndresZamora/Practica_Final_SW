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
    <title>Crear Album</title>
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
							document.getElementById("comprobacion2").innerHTML = "<div class='alert alert-success'><strong>EXITO!</strong> Se ha creado el album.</div>";
						}else{
							document.getElementById("comprobacion2").innerHTML = "<div class='alert alert-danger'><strong>ERROR!</strong> no se ha creado el Album.</div>";
						}
					}
				}		
				xmlhttp.open("POST","crearAlbumBD.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("nombre="+nombre);
			}else{
				document.getElementById("comprobacion2").innerHTML = "<div class='alert alert-danger'><strong>Rellenar los campos obligatorios</strong></div>";
			}
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
		  <li class="active">Crear Album</li>
		</ol>
	
		<h3 style="text-align:center"><b>CREAR ALBUM</b></h3><br>		
		<p style="text-align:center"><b>Los campos con * son obligatorios.</b></p><br>
		 <div id="comprobacion2"></div></br>
	
		<form class="form-horizontal">
		  <div class="form-group">
			<label for="name" class="col-sm-4 control-label">Nombre *</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="name" placeholder="Nombre del Album" required>
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
			  <button type="button" class="btn btn-default" onclick="CrearAlbum()">Crear Album</button>
			</div>
		  </div><br>
		</form>
    </div> <!-- /container -->
  </body>
</html>