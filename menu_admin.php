
<?php
	if((!isset($_SESSION['conectado']))&&($_SESSION['rol']!='Administrador')){
		header('location:index.php');
	}
	echo("
		<h3 style='text-align:center'><b>MENU ADMINISTRADOR</b></h3><br>		
		
		<div class='btn-group' role='group' aria-label='...'>
			<a href='darAltaSocios.php' class='btn btn-info' role='button'>Gestión Altas/Bajas Socios</a>
			<a href='borrarAlbumes.php' class='btn btn-info' role='button'>Borrar Albumes</a>
			<a href='borrarFotos.php' class='btn btn-info' role='button'>Borrar Fotos</a>
		</div><br><br>
	");
?>