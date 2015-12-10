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
//						document.getElementById("comprobacion2").innerHTML = "<p style='text-align:center'><b><font color=red>ERROR al crear el Album</font></b></p>";
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
  
<!--	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="index.html">
			<img src="images/pb.jpg" class="img-responsive" alt="PicBox" />
		  </a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<li><a href="creditos.html">About</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			  <ul class="dropdown-menu">
				<li><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">One more separated link</a></li>
			  </ul>
			</li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<label class="sr-only" for="exampleInputEmail3">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
				  </div>
				  <div class="form-group">
					<label class="sr-only" for="exampleInputPassword3">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
				  </div>
				  <button type="submit" class="btn btn-default">Conectarse</button>
				  <button type="submit" class="btn btn-default">Registrarse</button>
			</form>			
		  </ul>
		</div>
	  </div>
	</nav>-->
	
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