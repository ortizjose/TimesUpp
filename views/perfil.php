<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\usuarioDB.php';
$s = new SessionBean();
$g = new GenericDB();
$u = new usuarioDB();


  	$IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

	$usuario = $u -> getUsuario($IdUsu);



?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title> Mi Perfil - TimesUpp </title>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php require 'templates/GeneralCss.html';?>
</head>

<body class="sidebar-mini fixed">

<?php require 'templates/barSidebar.html';?>
      <!-- Dashboard Start -->
      <div class="content-wrapper">
         <!-- Container-fluid starts -->
         <!-- Main content starts -->
         <div class="container-fluid">
            <div class="row">
               <div class="main-header">
                  <h4>Mi Perfil</h4>
               </div>
            </div>
            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-lg-7">
                  <div class="card">
					  <div class="card-header text-center">
						<h4 class="card-header-text-2"> <?= $usuario[0]['Nombre']?> </h4>
					  </div>
					  
					   <div class="CardB1">
                         <div class="card-block">
							 
						 	<form id="formFotoPerfil" action="../controller/perfilController.php" method="post" enctype="multipart/form-data">						 
								<div class="profile-pic">
									<img class="p-photo" src="<?= $usuario[0]['Foto']?>"> 
									<input type="file" class="p-file" id="fotoPerfil" name="fotoPerfil" accept=".jpg, .jpeg, .png">
									<!--<label for="file" id="uploadButton">Cambiar Foto</label>-->
								</div>
							</form>
							 
							<div class="col-form-label form-control-label text-center"> 
								
							  <?php if (!empty($_GET['foto'])):
								 switch ($_GET['foto']):
								 case -1:?>

								  <a class="text-danger "> El archivo añadido no tiene extensión de imagen (.jpg .jpeg .png)</a>

							  <?php break;
								 case -2: ?>
								                   
								  <a class="text-danger"> La fotografía añadida supera los 5mb. Introduzca otra menos pesada.</a>
								
							  <?php break;
								 endswitch; endif;?>	
								
							</div>	
							 
							<div class="card-block row box-list text-center">
								<!-- Start a Box p-20 -->
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-0 waves-effect" data-toggle="tooltip" data-placement="top" title="Usuario">
										<p class="text-sm-center"> <?= $usuario[0]['Usuario']?> </p>
									</div>
								</div>
							
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-1 waves-effect" data-toggle="tooltip" data-placement="top" title="Email">
										<p class="text-sm-center "> <?= $usuario[0]['Email']?> </p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Recuento de contactos">
										<p class="text-sm-center"> Tripulantes: <?= $u -> getNumContactos($IdUsu);?> </p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Recuento de actividades">
										<p class="text-sm-center"> Programas Espaciales: <?= $u -> getNumActividades($IdUsu);?> </p>
									</div>
								</div>								
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-3 waves-effect" data-toggle="tooltip" data-placement="top" title="Recuento de grupos">
										<p class="text-sm-center"> Grupos de Astronautas : <?= $u -> getNumGrupos($IdUsu);?> </p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-4 waves-effect" data-toggle="tooltip" data-placement="top" title="Cita de Giuseppe Cocconi">
										<p class="text-sm-center">La probabilidad de éxito es difícil de estimar, pero si nunca buscamos, la oportunidad de tener éxito es cero.</p>
									</div>
								</div>	

							</div>	 
                      </div>
                  	</div>
					  
                  </div>
				</div>


				
               <div class="col-xl-5">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Administrar Mi Perfil</h5>
                     </div>

                
	
						 <div class="card-block accordion-block">
							<div class="accordion-box" id="single-open">

							   <a class="accordion-msg bg-info b-none">Cerrar Session</a>
							   <div class="accordion-desc">
		 
								</br>                       
							   	<div class="row">
								   <form class="form-inline" action="../controller/logoutController.php">
									 <div class="col-md-8 col-xs-12 form-group">
										<label class="form-control-label"> Si desea cerrar sesión, pulse este botón.</label>
									 </div>
									 <div class="col-md-4 col-xs-12" align="right">  
										<button type="sumbit" class="btn btn-pinterest btn-block btn-danger waves-effect waves-light">
											<span><i class="icon-logout"></i></span>Cerrar Sesión</button>
									 </div>	 
								   </form>
							   	</div>
								
							   </div>   

							   <a class="accordion-msg bg-info b-none">Cambiar Email</a>
							   <div class="accordion-desc">

									</br>	
									<form class="form-inline" action="../controller/perfilController.php" method="post">
										<div class="form-group" style="min-height: 50px; margin: 0 auto">
											<label for="antiguoEmail" class="form-control-label">Email Actual</label>
												<input id="antiguoEmail" name="antiguoEmail" type="email" class="form-control"  placeholder="ejemplo@timesupp.com" data-toggle="tooltip" title="Introduce el Email usado actualmente" required>
										</div>

										<div class="form-group">
											<label for="nuevoEmail" class="form-control-label">Nuevo Email </label>
												<input id="nuevoEmail" name="nuevoEmail" type="email" class="form-control"  placeholder="ejemplo@timesupp.com" data-toggle="tooltip" title="Introduce el nuevo Email" required>
										</div>

										<div class="form-check">
											<label for="inline1chk" class="form-check-label ">
												<input id="inline1chk" class="form-check-input" type="checkbox" required> Confirmar
											</label>
										</div>

										<button type="submit" class="btn btn-success waves-effect waves-light">Cambiar</button>

										 <div class="form-group" >

										  <?php if (!empty($_GET['email'])):
											 switch ($_GET['email']):
											 case -1:?>

											<div class="col-form-label form-control-label">                    
											  <a class="text-danger"> El email actual no es correcto.</a>
											</div>

										  <?php break;
											 case 1: ?>

											<div class="col-form-label form-control-label">                    
											  <a class="text-success"> El Email se ha actualizado correctamente.</a>
											</div>	

										  <?php break;
											 endswitch; endif;?>								
										 </div>									
									</form>							  

							   </div>
							 
							   <a class="accordion-msg bg-info b-none">Cambiar Contraseña</a>
							   <div class="accordion-desc">

									</br>	
									<form class="form-inline" action="../controller/perfilController.php" method="post">
										<div class="form-group" style="min-height: 50px; margin: 0 auto">
											<label for="antiguaContrasena" class="form-control-label">Contraseña Actual &nbsp</label>
												<input id="antiguaContrasena" name="antiguaContrasena" type="password" class="form-control" placeholder="********" data-toggle="tooltip" title="Introduce tu actual contraseña" required>
										</div>

										<div class="form-group" style="min-height: 50px; margin: 0 auto">
											<label for="nuevaContrasena" class="form-control-label">Nueva Contraseña &nbsp</label>
												<input id="nuevaContrasena" name="nuevaContrasena" type="password" class="form-control" placeholder="********" data-toggle="tooltip" title="Introduce tu nueva contraseña" required>
										</div>

										<div class="form-group">
											<label for="nuevaContrasena2" class="form-control-label">Repetir Contraseña </label>
												<input id="nuevaContrasena2" name="nuevaContrasena2" type="password" class="form-control" placeholder="********" data-toggle="tooltip" title="Repite tu nueva contraseña para confirmar." required>
										</div>

										<div class="form-check">
											<label for="inline2chk" class="form-check-label ">
												<input id="inline2chk" class="form-check-input" type="checkbox" required> Confirmar
											</label>
										</div>

										<button type="submit" class="btn btn-success waves-effect waves-light">Cambiar</button>

										 <div class="form-group">

										  <?php if (!empty($_GET['contrasena'])):
											 switch ($_GET['contrasena']):
											 case -2:?>

											<div class="col-form-label form-control-label">                    
											  <a class="text-danger"> Las nuevas contraseñas no coinciden. Vuelva a intentarlo.</a>
											</div>

										  <?php break;
											 case -1: ?>

											<div class="col-form-label form-control-label">                    
											  <a class="text-warning"> La contaseña actual no es correcta. Vuelva a intentarlo.</a>
											</div>	

										  <?php break;
											 case 1: ?>

											<div class="col-form-label form-control-label">									 
											  <a class="text-success"> La contraseña ha sido actualizada correctamente.</a>
											</div>

										  <?php break;
											 endswitch; endif;?>								
										 </div>									
									</form>


							   </div>
						  
							   <a class="accordion-msg bg-danger b-none">Eliminar Cuenta</a>
							   <div class="accordion-desc">
								  <p>
									 Esta parte la dejaremos para mas adelante, ya que para el borrado de la cuenta tenemos que tener en cuenta todos los factores que esto conlleva. Es por ello que hasta que no toquemos cada una de las partes que compone el proyecto no se va a proceder con este borrado.
								  </p>
							   </div>
							</div>
						 </div>	
							                   

                  </div>
               </div>
				


               </div>

            </div>
            <!-- 2-1 block end -->

          </div>

         </div>
         <!-- Main content ends -->
         <!-- Container-fluid ends -->

      </div>
   </div>

	<?php require 'templates/generalJs.html';?>
	<script>
		
	// Submit Automatico de Foto de Perfil
	document.getElementById("fotoPerfil").onchange = function(){
		document.getElementById('formFotoPerfil').submit();
	} 


	</script>



</body>

</html>
