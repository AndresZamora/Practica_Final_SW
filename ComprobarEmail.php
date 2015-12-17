<?php
	
	$enlace = mysqli_connect("localhost", "root", "", "picbox");   //Conexion con la base de datos en local.
	//	$enlace = mysqli_connect("mysql.hostinger.es", "u465939494_root", "quizes", "u465939494_quiz");		// Conexión con la base de datos en Hostinger.
	
	mysqli_set_charset($enlace, "utf8");
		
	if (!$enlace) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	
	$correo=$_POST['correo'];
		
	$resultado = $enlace->query("SELECT Email FROM usuario WHERE Email='$correo'");
	$cont= mysqli_num_rows($resultado);
	
	
	echo  $cont;
	mysqli_close($enlace);
?>