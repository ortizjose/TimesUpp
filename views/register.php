<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registrarse - TimesUpp</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="description" content="codedthemes">
	<meta name="keywords"
	content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
	<meta name="author" content="codedthemes">

	<!-- Favicon icon -->
	<link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
	<link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

	<!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

	<!--ico Fonts-->
	<link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">

	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">



</head>
<body>
	<section class="login common-img-bg">
		
	<!-- Video-background -->
	<video class="special-video" autoplay="autoplay" loop="loop" id="video_background" preload="auto" muted>
  		<source src="../assets/images/Index.mp4" type="video/mp4" />
	</video>
	<!-- end of video-background -->
		
		<!-- Container-fluid starts -->
		<div class="container-fluid">
			<div class="row">
					<div class="col-sm-12">
						<div class="login-card card-block bg-white">
							
						<div class="text-center">
							<img src="../assets/images/logo-black.png" alt="logo">
						</div>
						<h3 class="text-center txt-primary">Crea una cuenta</h3>						

						<?php if( !empty($_GET['register']) && $_GET['register'] == 'error1'): ?>

							<div class="text-center">
								<br />	
								<h6 class="text-center text-danger">
									Las contraseñas que se han introducido no coinciden. Vuelve a intentarlo.
								</h6>
								<br />
							</div>

						<?php elseif (!empty($_GET['register']) && $_GET['register'] == 'error2' ):?>

							<div class="text-center">
								<br />	
								<h6 class="text-center text-danger">
									Existe actualmente una cuenta con el Email introducido. Cambia el Email o inicia sesión.
								</h6>
								<br />
							</div>

						<?php elseif (!empty($_GET['register']) && $_GET['register'] == 'error3' ):?>

							<div class="text-center">
								<br />	
								<h6 class="text-center text-danger">
									El usuario indicado no está disponible. Prueba otro usuario y vuelve a intentarlo.
								</h6>
								<br />
							</div>							

							
						<?php elseif (!empty($_GET['register']) && $_GET['register'] == 'success' ):?>

							<div class="text-center">
								<br />	
								<h6 class="text-center text-success">
									Usuario creado correctamente.
								</h6>
									<form action="login.php">
										<div class="col-xs-8 offset-xs-2">
											<button type="submit" class="btn btn-inverse-success btn-md btn-block waves-effect waves-light m-b-20">Iniciar Sesión 
											</button>
										</div>
									</form>
								<br />
							</div>								

						<?php endif; ?>							
							
							
							
							
							<form class="md-float-material" action="../controller/registerController.php" method="post">

								

		
								<div class="row">
									<div class="col-md-6">
										<div class="md-input-wrapper">
											<input type="text" name="Nombre" class="md-form-control" required>
											<label>Nombre</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="md-input-wrapper">
											<input type="text" name="Apellido" class="md-form-control" required>
											<label>Apellido</label>
										</div>
									</div>
								</div>
								<div class="md-input-wrapper">
									<input type="text" name="Usuario" class="md-form-control" required>
									<label>Usuario</label>
								</div>								
								<div class="md-input-wrapper">
									<input type="email" name="Email" class="md-form-control" required>
									<label>Email</label>
								</div>
								<div class="md-input-wrapper">
									<input type="password" name="Contrasena" class="md-form-control" required>
									<label>Contraseña</label>
								</div>
								<div class="md-input-wrapper">
									<input type="password" name="ContrasenaConf" class="md-form-control" required>
									<label>Confirma tu Contraseña</label>
								</div>

								<div class="rkmd-checkbox checkbox-rotate checkbox-ripple b-none m-b-20">
									<label class="input-checkbox checkbox-primary">
										<input type="checkbox" id="checkbox">
										<span class="checkbox"></span>
									</label>
									<div class="captions">Recuerdame</div>
								</div>
								<div class="col-xs-10 offset-xs-1">
									<button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light m-b-20">Siguiente
									</button>
								</div>
								<div class="row">
									<div class="col-xs-12 text-center">
										<span class="text-muted">¿Ya tienes una cuenta?</span>
										<a href="login.php" class="f-w-600 p-l-5"> Iniciar Sesión</a>

									</div>
								</div>
							</form>
							<!-- end of form -->
						</div>
						<!-- end of login-card -->
					</div>
					<!-- end of col-sm-12 -->
				</div>
				<!-- end of row-->
			</div>
			<!-- end of container-fluid -->
	</section>



   <!-- Required Jqurey -->
   <script src="../assets/plugins/jquery/dist/jquery.min.js"></script>
   <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
   <script src="../assets/plugins/tether/dist/js/tether.min.js"></script>

   <!-- Required Fremwork -->
   <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

   <!--text js-->
   <script type="text/javascript" src="../assets/pages/elements.js"></script>
</body>
</html>
