
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
	if (isset($_POST['etiqueta'])&&isset($_POST['etiqueta2'])&&isset($_POST['etiqueta3'])){
		if (!mysqli_query($enlace,"UPDATE fotos
		SET Etiqueta='".$_POST['etiqueta']."',Etiqueta2='".$_POST['etiqueta2']."',Etiqueta3='".$_POST['etiqueta3']."' 
		WHERE ID='".$_SESSION['idFoto']."'")) {
			$n=0;
			echo $n;
		}else{
			$n=1;
			echo $n;
		}
	}
	

	mysqli_close($enlace);
?>
