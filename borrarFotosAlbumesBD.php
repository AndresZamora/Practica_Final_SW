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
	
	
	if(strcmp($_POST['operacion'],'BorrarFoto')==0){
		if (!mysqli_query($enlace,"DELETE FROM fotos WHERE ID='".$_POST['idFoto']."'")) {
			echo "ERROR";
		}else{
			echo "EXITO";
		}
	}else if(strcmp($_POST['operacion'],'BorrarAlbum')==0){
//		Borra el album con el mismo Id_Album y borra las fotos asociadas al album borrado.
		if ((!mysqli_query($enlace,"DELETE FROM fotos WHERE Id_Album='".$_POST['idAlbum']."'"))||(!mysqli_query($enlace,"DELETE FROM album WHERE ID='".$_POST['idAlbum']."'"))) {
			echo "ERROR";
		}else{
			echo "EXITO";
		}
	}
	
	mysqli_close($enlace);
?>