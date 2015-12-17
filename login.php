
<?php
	if (isset($_POST["email"]) && isset($_POST["password"])){
		$esta=0;
		$user = $_POST["email"];
		$pass = $_POST["password"];
		$pass_cifrado=md5($pass);
		
		$enlace = mysqli_connect("localhost", "root", "", "picbox");   //Conexion con la base de datos en local.
	//	$enlace = mysqli_connect("mysql.hostinger.es", "u465939494_root", "quizes", "u465939494_quiz");		// Conexión con la base de datos en Hostinger.
	
		mysqli_set_charset($enlace, "utf8");
		
		if (!$enlace) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
				
		$res = $enlace->query("SELECT * FROM usuario WHERE Email='$user' AND Password='$pass_cifrado'"); //Seleccionar la ultima conexion del usuario(la actual).
		$cont= mysqli_num_rows($res);
//		echo "<p>('Rol: $rol y '".$_SESSION['rol']."'.')</p>";	
		
		if(($cont==1)){	
			$res->data_seek(0);
			$fila=$res->fetch_assoc();
			
			if($fila['Estado']=='Alta'){			
				session_start();
				session_regenerate_id(true);
				$_SESSION['rol']= $fila['Rol']; //Variable de sesion para el rol del usuario.
				
				$esta=1;		
		//		include ("conexiones.php");
				$_SESSION['conectado']=1 ;
				$_SESSION['usuarioactual'] = $user; //nombre del usuario logueado.
				header("Location: index.php");
			}else if($fila['Estado']=='Baja'){
				$esta=2;
			}
		}
		
		if ($esta==0){
			echo"<script>alert('El Usuario no existe, contraseña o email incorrectos.');window.location.href=\"index.php\"</script>";	
		}else if($esta==2){
			echo"<script>alert('El Usuario no esta dado de Alta, revisar su correo para darse de Alta.');window.location.href=\"index.php\"</script>";
		}
	}
?>