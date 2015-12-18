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
			
			$resultado = $enlace->query("SELECT * FROM album");
			
			echo("
				<table class='table'>
					<tr class='success'>
						<td><b>ID</b></td>
						<td><b>Nombre Album</b></td>		
						<td><b>Usuario</b></td>
						<td></td>
					</tr>");	
			for ($num_fila = 0; $num_fila <= $resultado->num_rows - 1; $num_fila++) {
				$resultado->data_seek($num_fila);
				$fila = $resultado->fetch_assoc();
				echo("
					<tr>
						<td><b>".$fila['ID']."</b></td>
						<td>".$fila['Nombre']."</td>		
						<td>".$fila['Email']."</td>
						<td><button type='button' class='btn btn-primary' role='button' onclick='BorrarAlbumes(".$fila['ID'].")'>Borrar</button></td>
					");
			}
			echo("</table>");
			
			mysqli_close($enlace);
		?>