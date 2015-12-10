
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
	session_start();
	if (!mysqli_query($enlace,"INSERT INTO album(Nombre,Email) 
		VALUES('".$_POST['nombre']."','".$_SESSION['usuarioactual']."')")) {
		echo "ERROR";
	}else{
		echo "EXITO";
	}
?>