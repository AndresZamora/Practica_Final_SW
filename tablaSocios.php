
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
			
			$resultado = $enlace->query("SELECT * FROM usuario WHERE Rol = 'Socio'");
			
			echo("
<!--				<div class='table-responsive'>-->
				<table class='table'>
					<tr class='success'>
						<td><b>Email</b></td>
						<td><b>Nickname</b></td>		
						<td><b>Rol</b></td>
						<td><b>Estado</b></td>
						<td></td>
					</tr>");	
			for ($num_fila = 0; $num_fila <= $resultado->num_rows - 1; $num_fila++) {
				$resultado->data_seek($num_fila);
				$fila = $resultado->fetch_assoc();
				echo("
					<tr>
						<td>".$fila['Email']."</td>
						<td>".$fila['Nickname']."</td>		
						<td>".$fila['Rol']."</td>
						<td>".$fila['Estado']."</td>
					");
					$email= '"'.$fila['Email'].'"';
					if($fila['Estado']=='Alta'){
						echo ("<td><button type='button' class='btn btn-primary' role='button' onclick='OperacionDarBaja($email)'>Dar Baja</button></td></tr>");
					}else if($fila['Estado']=='Baja'){
						echo ("<td><button type='button' class='btn btn-primary' role='button' onclick='OperacionDarAlta($email)'>Dar Alta</button></td></tr>");
					}
			}
			echo("</table>
<!--				</div>-->");
			
			mysqli_close($enlace);
		?>