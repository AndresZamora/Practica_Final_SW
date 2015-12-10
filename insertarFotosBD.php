
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
	
	if (!isset($_POST['etiqueta'])){
		//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
		//y que el tamano del archivo no exceda los 16mb
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 16384; //16mb es el limite de medium blob
		 
		if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		 
			//este es el archivo temporal
			$imagen_temporal  = $_FILES['imagen']['tmp_name'];  
			//este es el tipo de archivo
			$tipo = $_FILES['imagen']['type'];
			//leer el archivo temporal en binario
			$fp     = fopen($imagen_temporal, 'r+b');
			$data = fread($fp, filesize($imagen_temporal));
			fclose($fp);
			//escapar los caracteres
			$data= mysqli_real_escape_string ($enlace, $data);
/*			$resultado = mysqli_query($enlace,"INSERT INTO usuario(Email,Nombre,Password,Telefono,Especialidad,Interes,Imagen) 
			VALUES('".$_POST['email']."','".$_POST['firstname']."','".$_POST['password']."',".$_POST['telephone'].",'".$_POST['especialidad']."','".$_POST['interes']."', '$data')");
			
			if ($resultado){
				echo ("<h2>EXITO: Se ha insertado correctamente los datos en la tabla, el archivo ha sido copiado exitosamente</h2><br>
					<a href='VerUsuariosConFoto.php'>Usuarios Insertados</a>");
			} else {
				echo "<h2>ERROR: Falló en la inserción en la tabla, ocurrio un error al copiar el archivo.</h2>";
			}*/			
			if (!mysqli_query($enlace,"INSERT INTO fotos(Id_Album,Imagen,Descripcion,Visibilidad) 
				VALUES('".$_SESSION['idAlbum']."','$data','".$_POST['descripcion']."','".$_POST['visibilidad']."')")) {
//				echo "ERROR";
				echo "<h2>ERROR: Falló en la inserción en la tabla, ocurrio un error al copiar el archivo.</h2>";
			}else{
//				echo "EXITO";
				echo ("<h2>EXITO: Se ha insertado correctamente la foto en la BD</h2><br>
					<a href='insertarFotos.php'>Volver atras</a>");
			}	
		} else {
			echo "<h2>ERROR: Falló en la inserción en la tabla, archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes</h2>";
		}
	}else{		
		$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
		$limite_kb = 16384; //16mb es el limite de medium blob
		 
		if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
			//este es el archivo temporal
			$imagen_temporal  = $_FILES['imagen']['tmp_name'];  
			//este es el tipo de archivo
			$tipo = $_FILES['imagen']['type'];
			//leer el archivo temporal en binario
			$fp     = fopen($imagen_temporal, 'r+b');
			$data = fread($fp, filesize($imagen_temporal));
			fclose($fp);
			//escapar los caracteres
			$data= mysqli_real_escape_string ($enlace, $data);

			if (!mysqli_query($enlace,"INSERT INTO fotos(Id_Album,Imagen,Descripcion,Visibilidad,Etiqueta) 
				VALUES('".$_SESSION['idAlbum']."','$data','".$_POST['descripcion']."','".$_POST['visibilidad']."','".$_POST['etiqueta']."')")) {
				echo "<h2>ERROR: Falló en la inserción en la tabla, ocurrio un error al copiar el archivo.</h2>";
			}else{
//				echo "EXITO";
				echo ("<h2>EXITO: Se ha insertado correctamente la foto en la BD</h2><br>
					<a href='insertarFotos.php'>Volver atras</a>");
			}		
		}else {
			echo "<h2>ERROR: Falló en la inserción en la tabla, archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes</h2>";
		}
	}
?>