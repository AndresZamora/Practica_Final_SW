
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
	
	if (filter_var($_POST['password'], FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^([a-zA-Z\d]){6,}$/")))){
		if (!mysqli_query($enlace,"INSERT INTO usuario(Email,Nickname,Password,Rol,Estado) 
			VALUES('".$_POST['email']."','".$_POST['nickname']."','".md5($_POST['password'])."','Socio','Baja')")) {
			$n=0;
			echo $n;
		}else{
			$n=1;
			echo $n;
		}
	}
	

	mysqli_close($enlace);
?>
