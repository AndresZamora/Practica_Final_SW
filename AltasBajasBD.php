<?php	

//	if (isset($_POST["numId"]) && isset($_POST["pregunta"]) && isset($_POST["respuesta"])){
		
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
	
	if(strcmp($_POST['operacion'],'DarAlta')==0){
		if (!mysqli_query($enlace,"UPDATE usuario SET Estado='Alta' WHERE Email='".$_POST['email']."'")) {
//			echo "<p><b>ERROR: Fallo en la modificación de la pregunta</b></p>";
			echo "ERROR";
		}else{
//			echo "<p><b>EXITO: Se ha modificado correctamente la pregunta en la BD</p></b> ";
			echo "EXITO";
		}
	}else if(strcmp($_POST['operacion'],'DarBaja')==0){
		if (!mysqli_query($enlace,"UPDATE usuario SET Estado='Baja' WHERE Email='".$_POST['email']."'")) {
			echo "ERROR";
		}else{
			echo "EXITO";
		}
	}
	
	mysqli_close($enlace);
?>