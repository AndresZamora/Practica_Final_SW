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
    <title>Etiquetar Fotos</title>
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
		
		
				function EtiquetarFotos() {
			var et1=document.getElementById("etiqueta").value;
			var et2=document.getElementById("etiqueta2").value;
			var et3=document.getElementById("etiqueta3").value;
			
			
			if((et1!="")&&(et2!="")&&(et3!="")){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					//	document.getElementById("comprobacion3").innerHTML = xmlhttp.responseText;
						var msj = parseInt(xmlhttp.responseText);
						if(msj==1){
							document.getElementById("comprobacion3").innerHTML = "<div class='alert alert-success'><strong>EXITO!</strong> Se ha etiquetado la foto con éxito.</div>";
						}else{
							document.getElementById("comprobacion3").innerHTML = "<div class='alert alert-danger'><strong>ERROR!</strong> Fallo al etiquetar la foto, inténtalo de nuevo.</div>";
						}
						//document.getElementById("comprobacion3").innerHTML =xmlhttp.responseText;
					}
				}		
				xmlhttp.open("POST","etiquetarBD.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.send("etiqueta="+et1+"&etiqueta2="+et2+"&etiqueta3="+et3);
			}else{
				document.getElementById("comprobacion3").innerHTML = "<div class='alert alert-danger'><strong>Rellenar los campos obligatorios</strong></div>";
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
		  <li><a href="gestionAlbumes.php">Gestion Album</a></li>
		  <li><a href="verFotos.php">Ver Fotos</a></li>
		  <li class="active">Etiquetar Fotos</li>
		</ol>
		
		<h3 style="text-align:center"><b>ETIQUETAR FOTOS</b></h3><br>
		<p style="text-align:center"><b>Los campos con * son obligatorios.</b></p><br>		
		<div id="comprobacion3"></div><br>
		
		<form class="form-horizontal">
		  <div class="form-group">
			<label for="etiqueta" class="col-sm-4 control-label">Etiqueta *</label>
			<div class="col-sm-6">
			  <input class="form-control" name="etiqueta" id="etiqueta" type="text" placeholder="Casa,campo,monte..." required/><br>
			 </div>
		  </div>
		  <div class="form-group">
			<label for="etiqueta2" class="col-sm-4 control-label">Etiqueta *</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="etiqueta2" id="etiqueta2" placeholder="Casa,campo,monte..." required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="etiqueta3" class="col-sm-4 control-label">Etiqueta *</label>
			<div class="col-sm-6">
			  <input type="text" class="form-control" name="etiqueta3" id="etiqueta3" placeholder="Casa,campo,monte..." required>
			</div>
		  </div>
		     <div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
				<button type="button" class="btn btn-success" id="btn_eti" onclick="EtiquetarFotos()">Etiquetar Fotos</button>
				</div>
			</div>
		 </form>

		
    </div> <!-- /container -->
  </body>
</html>