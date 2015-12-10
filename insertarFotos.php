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
    <title>Añadir Fotos</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">	
	<link href="css/style.css" rel="stylesheet">
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
	<script>
	
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	
		function InsertarFoto() {
			var descripcion=document.getElementById("descripcion").value;
			var visibilidad=document.getElementById("visibilidad").value;
			var imagen=document.getElementById("imagen").value;
			var etiqueta=document.getElementById("etiqueta").value;
			
			if((descripcion!="")&&(visibilidad!="")&&(imagen!="")){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("comprobacion2").innerHTML = xmlhttp.responseText;
/*						if(xmlhttp.responseText.toString().search("EXITO")!=-1){
							document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b><font color=green>Insertada la foto con EXITO</font></b></p>";
						}else{
							document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b><font color=red>ERROR al insertar la foto</font></b></p>";
						}*/
					}
				}		
				xmlhttp.open("POST","insertarFotosBD.php",true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				if((etiqueta!="")){
					xmlhttp.send("descripcion="+descripcion+"&visibilidad="+visibilidad+"&imagen="+imagen+"&etiqueta="+etiqueta);
				}else{
					xmlhttp.send("descripcion="+descripcion+"&visibilidad="+visibilidad+"&imagen="+imagen);
				}
			}else{
				document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b>Rellenar los campos obligatorios</b></p>";
			}
		}
		
		$(document).ready(function(){
			function elegir_imagen(evt) {
				var files = evt.target.files;
				var f= files[0];
				var reader = new FileReader();
             
				reader.onload = (function(theFile) {
					return function(e) {
						document.getElementById("im").innerHTML = ['<img src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
					};
				})(f);             
				reader.readAsDataURL(f);
			}
            document.getElementById('imagen').addEventListener('change', elegir_imagen, false);
		});
	
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
		  <li class="active">Añadir Foto</li>
		</ol>
	
		<h3 style="text-align:center"><b>AÑADIR UNA FOTO</b></h3><br>		
		<p style="text-align:center"><b>Los campos con * son obligatorios.</b></p><br>
	
		<form action="insertarFotosBD.php" class="form-horizontal" enctype="multipart/form-data" method="POST">
		  <div class="form-group">
			<label for="imagen" class="col-sm-4 control-label">Imagen *</label>
			<div class="col-sm-4">
			  <input class="form-control" name="imagen" id="imagen" type="file" required/><br>
			  <output id="im"></output>
			</div>
		  </div>
		  <div class="form-group">
			<label for="descripcion" class="col-sm-4 control-label">Descripción *</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción de la foto" data-toggle="tooltip" data-placement="right" title="Tooltip on right" required>
			</div>
		  </div>
		  <div class="form-group">
			<label for="visibilidad" class="col-sm-4 control-label">Visibilidad *</label>
			<div class="col-sm-4">			  
			  <select name="visibilidad" class="form-control" name="visibilidad" id="visibilidad">
				<option value="privada">Privada</option>
				<option value="accesoLimitado">Acceso Limitado</option>
				<option value="publica">Pública</option>
			  </select>
			</div>
		  </div>
		  <div class="form-group">
			<label for="etiqueta" class="col-sm-4 control-label">Etiquetar</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" name="etiqueta" id="etiqueta" placeholder="Etiqueta de la foto" data-toggle="tooltip" data-placement="right" title="Tooltip on right">
			</div>
		  </div>
		  <div class="form-group">
			<div class="col-sm-offset-4 col-sm-4">
<!--			  <button type="button" class="btn btn-success" onclick="InsertarFoto()">Añadir Foto</button>-->
			  <button type="submit" class="btn btn-success" >Añadir Foto</button>
			</div>
		  </div><br>
		  <div id="comprobacion2"></div></br>
		</form>
    </div> <!-- /container -->
  </body>
</html>