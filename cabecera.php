
<?php
	echo("
		<nav class='navbar navbar-default'>
		  <div class='container-fluid'>
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class='navbar-header'>
			  <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			  </button>
			  <a class='navbar-brand' href='index.php'>
				<img src='images/pb.jpg' class='img-responsive' alt='PicBox' />
			  </a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
			  <ul class='nav navbar-nav'>
				<li><a href='creditos.html'>About</a></li>
				<li class='dropdown'>
				  <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Dropdown <span class='caret'></span></a>
				  <ul class='dropdown-menu'>
					<li><a href='#'>Action</a></li>
					<li><a href='#'>Another action</a></li>
					<li><a href='#'>Something else here</a></li>
					<li role='separator' class='divider'></li>
					<li><a href='#'>Separated link</a></li>
				  </ul>
				</li>
			  </ul>
			  <ul class='nav navbar-nav navbar-right'>
	");
//				<?php
//					session_start();
					if (!isset($_SESSION['conectado'])){
							echo ("							
								<form action='login.php' class='navbar-form navbar-left' role='search' method='POST'>
									<div class='form-group'>
										<input type='email' class='form-control' name='email' id='email' placeholder='Email' required>
									</div>
									<div class='form-group'>
										<input type='password' class='form-control' name='password' id='password' placeholder='Password' required>
									</div>
									<button type='submit' class='btn btn-success'>Conectarse</button>
									<a href='#' class='btn btn-primary' role='button'>Registrarse</a>
								</form>
							");
					}else{
						if($_SESSION['rol']=='Socio'){
							echo ("
								<form class='navbar-form navbar-left' role='search'>
								<div class='form-group'>
								<p>Usuario: '".$_SESSION['usuarioactual']."'</p>
								</div>
								<div class='form-group'>
								<a href='cerrar.php' class='btn btn-danger' role='button'>Logout</a>
								</div>
								</form>
							");
						}else if($_SESSION['rol']=='Administrador'){
							echo ("
								<span class='right'><p>Usuario Profesor: '".$_SESSION['usuarioactual']."'</p></span>
								<span class='right'><a href='cerrar.php'>Logout</a></span>
							");
						}
					}

	echo("
			  </ul>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	
	");


?>