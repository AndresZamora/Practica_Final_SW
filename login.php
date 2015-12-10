<?php include ("seguridad.php");?>
<?php
	if (isset($_POST["email"]) && isset($_POST["password"])){
		$esta=0;
		$user = $_POST["email"];
		$pass = $_POST["password"];
		
		$enlace = mysqli_connect("localhost", "root", "", "picbox");   //Conexion con la base de datos en local.
	//	$enlace = mysqli_connect("mysql.hostinger.es", "u465939494_root", "quizes", "u465939494_quiz");		// Conexión con la base de datos en Hostinger.
	
		mysqli_set_charset($enlace, "utf8");
		
		if (!$enlace) {
			echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
		
//		$resultado = $enlace->query("SELECT Email, Password, Rol FROM usuario WHERE Email='$user' AND Password='$pass' ");
//		$cont= mysqli_num_rows($resultado);
		
		
		$res = $enlace->query("SELECT Rol FROM usuario WHERE Email='$user' AND Password='$pass'"); //Seleccionar la ultima conexion del usuario(la actual).
		$cont= mysqli_num_rows($res);
		$res->data_seek(0);
		$r=$res->fetch_assoc();
		$rol=implode("", $r);
		session_start();
		$_SESSION['rol']= $rol; //Variable de sesion para el rol del usuario.
		
//		echo "<p>('Rol: $rol y '".$_SESSION['rol']."'.')</p>";	
		
		if($cont==1){			
			$esta=1;		
	//		include ("conexiones.php");
			$_SESSION['conectado']=1 ;
			$_SESSION['usuarioactual'] = $user; //nombre del usuario logueado.
			header("Location: index.php");
	//		echo "<script>alert('Usuario conectado correctamente')</script>";
		}
		
		if ($esta==0){
			echo"<script>alert('El Usuario no existe, contraseña o email incorrectos.');window.location.href=\"index.php\"</script>";	
		}
	}
		
		
/*		if(($_SESSION['rol']=="Socio")){
//			$_SESSION['rol'] = "Estudiante";
			header("Location: index.php"); // Redirección del navegador
			exit;
		}else if($_SESSION['rol']=="Administrador"){
//			$_SESSION['rol'] = "Profesor";
			header("Location: index.php"); // Redirección del navegador 
			exit;
		}*/
		
		
/*		if($cont==1){			
			$esta=1;
			session_start();
			include ("conexiones.php");
			$_SESSION['conectado']=1 ;
			$_SESSION['usuarioactual'] = $user; //nombre del usuario logueado.
			echo "<script>alert('Usuario conectado correctamente')</script>";
			
			if((strpbrk($user, '@')=="@ikasle.ehu.es")||(strpbrk($user, '@')=="@ikasle.ehu.eus")){
				$_SESSION['rol'] = "Estudiante";
				header("Location: layout.php"); /* Redirección del navegador */
/*				exit;
			}else if(strpbrk($user, '@')=="@ehu.es"){
				$_SESSION['rol'] = "Profesor";
				header("Location: layout.php"); // Redirección del navegador 
				exit;
			}
			
		}
		
		if ($esta==0){
			echo"<script>alert('El Usuario no existe, contraseña o email incorrectos.');window.location.href=\"Login.php\"</script>";	
		}
	}*/

?>