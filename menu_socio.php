<?php
//	include ("seguridad.php");
	if((!isset($_SESSION['conectado']))&&($_SESSION['rol']!='Socio')){
		header('location:index.php');
	}
?>
<?php
	echo("
		<h3 style='text-align:center'><b>MENU SOCIO</b></h3><br>		
		
		<div class='btn-group' role='group' aria-label='...'>
			<a href='crearAlbum.php' class='btn btn-info' role='button'>Crear Album</a>
			<a href='gestionAlbumes.php' class='btn btn-info' role='button'>Gestionar Albumes</a>
			<button type='button' class='btn btn-default'>Right</button>
		</div><br><br>
	");
?>