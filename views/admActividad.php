<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\grupoDB.php';
include '..\model\actividadDB.php';
$s = new SessionBean();
$g = new genericDB();
$gr = new GrupoDB();
$a = new ActividadDB();

	$IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])):
    	header('Location: ..\views\login.php');  
	endif;

	$actividades = $a -> getActividadesUsuario($IdUsu);

?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title> Actividades - TimesUpp </title>

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
                  <h4>Administrar Actividad</h4>
               </div>
            </div>

            <!-- 2-1 block start -->
            <div class="row">
 
               <div class="col-xl-7">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Borrar/Modificar Actividad</h5>
                     </div>
						
                      <div class="CardB1">
                        <div class="card-block">
							
						<?php if ( empty($actividades) ): ?>
						 
						 <div id="blank" style="min-height: 50px; margin: 0 auto"></div>
						 <div style="text-align: center;">
						  <span style="font-size: 200px; color: #3D505A;" ><i class="icofont icofont-magic"></i></span>
						  <h3> ¿Que piensas que esta aplicación es mágica? Estamos trabajando para ello pero si no añades alguna actividad/es no vamos a poder ayudarte a organizar nada. </h3>			
						 </div>

						<?php else:?>							
							
                        <table class="table table-hover" >
                         <thead>
                            <tr>
                               <th>Actividad</th>
                               <th>Modificar</th>
                               <th>Borrar</th>
                            </tr>
                         </thead>
                         <tbody>
							 
						<?php $i = 0; foreach ($actividades as $actividad): ?>
                            
							<tr>
								<td> <?= $actividad['Nombre'] ?> </td>

								<td> <button class="btn btn-info btn-icon waves-effect" data-toggle="collapse" data-target="#collapseOne_<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
									 <i class="icon-note"></i></button>
								</td>	

								<td> <button class="btn btn-danger btn-icon waves-effect" data-toggle="collapse" data-target="#collapseTwo_<?= $i ?>" aria-expanded="true">
									 <i class="icon-trash icon-white"></i></button>
								</td>
								

							</tr>
							 
							<tr>
								<td colspan=3>
									
									<!-- Collapse con la Actividad a Modificar -->
									<div id="collapseOne_<?= $i ?>" class="collapse show"  >
										
										<form action="../controller/admActividadController.php" method="post">
										  <div class="form-group row">
											 <label for="example-text-input" class="col-md-2 col-form-label form-control-label">Nuevo Nombre</label>
											 <div class="col-md-7">
												<input class="form-control" type="text" name="modificarActividad" placeholder="<?= $actividad['Nombre'] ?>" value="<?= $actividad['Nombre'] ?>" >
											 </div>
											  
										  </div>
											  
										  <div class="form-group row">
											 <label for="example-text-input" class="col-md-2 col-form-label form-control-label">Nuevo Grupo</label>
											 <div class="col-md-7">
												<select class="form-control " name="grupoModificarActividad" id="Grupo">
													<option value="Ninguno" >Ninguno</option>

													<?php foreach (($gr -> getGruposUsuario($IdUsu)) as $grupo): 
															if (($a -> getIdGrupoActividad($actividad['IdAct'])) != $grupo['IdGrupo']): ?>

																<option value="<?= $grupo['IdGrupo'] ?>" > <?= $grupo['Nombre'] ?> </option>
															
													  <?php else: ?>
													
																<option value="<?= $grupo['IdGrupo'] ?>" selected> <?= $grupo['Nombre'] ?> </option>
														
													<?php endif; endforeach; ?>

												</select>
											  </div>
											</div>
											
											<div class="row">
												<div class="col-md-9 text-right"> 
											 		<button type="submit" class="btn btn-success waves-effect waves-light" name="idActividad" value="<?= $actividad['IdAct'] ?>">Aplicar</button>
												</div>
											</div>
										</form>								   
	   
									</div>
								   
							   		<!-- Collapse con la Actividad a Eliminar -->								
									<div id="collapseTwo_<?= $i ?>" class="collapse show"  >
										
										</br>
										<form action="../controller/admActividadController.php" method="post">
										  <div class="form-group row">
										  	<div class="col-md-5">
											 	<label for="example-text-input" class=" form-control-label">¿Eliminar la actividad " <?= $actividad['Nombre'] ?> " ?</label>											  
											 </div>
											  
											 <div class="col-md-4 text-right">
												 <div class="checkbox-color checkbox-danger" align="center">
												  <input id="checkbox_<?= $i ?>" type="checkbox" required="required" name="borraActividad" value="<?= $actividad['IdAct'] ?>">
													  <label for="checkbox_<?= $i ?>" class="form-control-label text-danger">Confirmar</label>
												 </div>
				
											 <button type="submit" class="btn btn-danger waves-effect waves-light">Eliminar</button>
											 </div>
										  </div>
										</form>	

									</div>								
									
								</td>
							 </tr>
						 
						<?php $i++; endforeach; endif; ?>

                         </tbody>
                        </table>

                      </div>
                     </div>
                    </div>
                </div>

               <div class="col-xl-5 col-lg-12">
                  <div class="card">
                    <div class="addCardCrearActividad">
                      <div class="card-header">
                        <h5 class="card-header-text">Crear Actividad</h5>
                      </div>
						
                        <div class="card-block">
                           <form action="../controller/admActividadController.php" method="post">
							   
                              <div class="form-group row">
                                 <label for="h-nombre" class="col-md-2 col-form-label form-control-label">Nombre</label>
                                 <div class="col-md-10">
                                    <input type="text" id="h-nombre" name="nuevaActividad" class="form-control" placeholder="Nombre de la actividad"  data-toggle="tooltip" data-placement="top" title="Introduzca un nombre para la nueva actividad." required>
                                 </div>
                              </div>
							   
                              <div class="form-group row">
                                 <label class="col-md-2 col-form-label form-control-label">Grupo</label>
                                 <div class="col-md-10">
									<select class="form-control" name="grupoNuevaActividad" data-toggle="tooltip" data-placement="top" title="Seleccione un grupo si quiere que la actividad sea grupal.">
                                            <option value="Ninguno">Ninguno</option>
                                          
                                             <?php foreach (($gr -> getGruposUsuario($IdUsu)) as $grupo): ?>
                                                <option value="<?= $grupo['IdGrupo'] ?>"> <?= $grupo['Nombre'] ?> </option>
                                             <?php endforeach; ?>
                                            
                                        </select>
                                 </div>
                              </div>
							   
                              <div class="row">
								 <div class="col-md-6 col-xs-6 col-form-label form-control-label"> 
									 
								  <?php if( !empty($_GET['res']) && $_GET['res'] == 1):?>
								 	<label class="text-success" > Actividad creada correctamente.</label>
								  <?php endif; ?>
									 
								 </div>
                                 <div class="col-md-6 col-xs-6 text-right" >
                                    <button type="submit" class="btn btn-info btn-md waves-effect waves-light">Crear</button>
								 </div>
                              </div>

                           </form> 
                          </div>

                    </div>
                  </div>
                </div>				
				
				
             </div>
            <!-- 2-1 block end -->

         <!-- Main content ends -->
         <!-- Container-fluid ends -->

		  </div>
	   </div>
         
  <?php require 'templates/generalJs.html';?>

</body>

</html>
