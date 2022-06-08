
<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\usuarioDB.php';
include '..\model\grupoDB.php';
$s = new SessionBean();
$g = new GenericDB();
$u = new UsuarioDB();
$gr = new GrupoDB();

  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}
	
  $grupos = $gr -> getGruposUsuario($IdUsu);
  $contactos = $u -> getContactos($IdUsu);

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title> Grupos - TimesUpp </title>

	<!-- Meta -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php require 'templates/GeneralCss.html';?>

<body class="sidebar-mini fixed">

<?php require 'templates/barSidebar.html';?>

      <!-- Dashboard Start -->
      <div class="content-wrapper">
         <!-- Container-fluid starts -->
         <!-- Main content starts -->
         <div class="container-fluid">
            <div class="row">
               <div class="main-header">
                  <h4>Acciones sobre Grupos</h4>
               </div>
            </div>

            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-xl-7">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Borrar/Modificar Grupo</h5>
                     </div>
						
                      <div class="CardB1">
                        <div class="card-block">
						
						<?php if (empty($grupos)): ?>
							
						 <div id="blank" style="min-height: 50px; margin: 0 auto"></div>
						 <div style="text-align: center;">
						  <span style="font-size: 200px; color: #3D505A;" ><i class="icofont icofont-space-shuttle "></i></span>
						  <h3> Si quieres construir una nave espacial necesitarás ayuda. Crea grupos para compartir actividades y así repartir las tareas ¿A que esperas?</h3>	
						 </div>
	
						<?php else: ?>
							
                        <table class="table table-hover" >
                         <thead>
                            <tr>
                               <th>Grupo</th>
                               <th>Modificar</th>
							   <th>Salir</th>
                               <th>Borrar</th>
                            </tr>
                         </thead>
                         <tbody>
							 
						<?php $i = 0;
							 	foreach ($grupos as $grupo): ?>
                            
							<tr>
								<td> <?= $grupo['Nombre'] ?> </td>

								<td> <button class="offset-xs-1 btn btn-info btn-icon waves-effect" data-toggle="collapse" data-target="#collapseOne_<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
									 <i class="icon-note"></i></button>
								</td>
								
								<td> <button class="btn btn-danger btn-icon waves-effect" data-toggle="collapse" data-target="#collapseTwo_<?= $i ?>" aria-expanded="true">
									 <i class="icon-share-alt icon-white"></i></a>
								</td>
								
								<td> <button class="btn btn-danger btn-icon waves-effect" data-toggle="collapse" data-target="#collapseThree_<?= $i ?>" aria-expanded="true">
									 <i class="icon-trash icon-white"></i></a>
								</td>
								

							</tr>
							 
							<tr>
								<td colspan=4>
									
									<!-- Collapse con la Actividad a Modificar -->
									<div id="collapseOne_<?= $i ?>" class="collapse show"  >
										
										<form action="../controller/admGruposController.php" method="post">
											
										  <div class="form-group row">
											 <label for="example-text-input" class="col-md-3 col-form-label form-control-label">Nuevo Nombre</label>
											 <div class="col-md-7">
												<input class="form-control" type="text" name="modificarGrupo" placeholder="<?= $grupo['Nombre'] ?>" value="<?= $grupo['Nombre'] ?>" >
											 </div>
											  
										  </div>
											  
										  <div class="form-group row">
										   <label for="example-text-input" class="col-md-3 col-xs-4 col-form-label form-control-label">Modificar Integrantes</label>
										   <div class="col-md-7 col-xs-8">
											 	<!-- Pequeño problema. Id es único y por lo tanto en js de advance-form.js hay que poner una línea de id. CSS en boostrap-multiselect.css-->
												<select class="form-control multiple-selected"  name="integrantesModificarGrupo[]" multiple="multiple" required>                   
												  <?php foreach ($gr -> getIntegrantesContactos($grupo['IdGrupo'], $IdUsu) as $integrante): 
												   if ( $integrante['IdGrupo'] == $grupo['IdGrupo'] ):?>

													<option value="<?= $integrante['IdUsu'] ?>" selected> <?= $integrante['Nombre'] ?></option>
												  <?php else: ?>

													<option value="<?= $integrante['IdUsu'] ?>"> <?= $integrante['Nombre'] ?></option>  

												  <?php endif; endforeach; ?>


												</select>
										   </div>
										  </div>
											
											 <div class="row">
												<div class="col-md-10 text-right"> 											 
											 		<button type="submit" class="btn btn-success waves-effect waves-light" name="idGrupo" value="<?= $grupo['IdGrupo'] ?>">Aplicar</button>
												</div>
											</div>
										  
											
										</form>								   
	   
									</div>

							   		<!-- Collapse con la Actividad a Eliminar -->								
									<div id="collapseTwo_<?= $i ?>" class="collapse show">
										
										</br>
										<form action="../controller/admGruposController.php" method="post">
										  <div class="form-group row">
											 <label for="example-text-input" class="col-md-6 col-form-label form-control-label">¿Desea salir del grupo " <?= $grupo['Nombre'] ?> " ?</label>
											  
											 <div class="col-md-4 text-right"> 
												 <div class="checkbox-color checkbox-danger">
												  	<input id="checkbox_<?= $i ?>" type="checkbox" required="required" name="salirGrupo" value="<?= $grupo['IdGrupo'] ?>">
													  <label for="checkbox_<?= $i ?>" class="form-control-label text-danger">Confirmar</label>
												 </div>

												 <button type="submit" class="btn btn-danger waves-effect waves-light">Salir</button>
											 </div>
										  </div>
										</form>	

									</div>									
									
									
							   		<!-- Collapse con la Actividad a Eliminar -->								
									<div id="collapseThree_<?= $i ?>" class="collapse show"  >
										
										</br>
										<form action="../controller/admGruposController.php" method="post">
										  <div class="form-group row">
											  
											  <?php if ($gr -> numeroActividadesGrupo($grupo['IdGrupo'])!=0):?>
												 <label for="example-text-input" class="col-md-6 col-form-label form-control-label">El grupo "<?= $grupo['Nombre'] ?>" tiene actividades relacionadas ¿Desea eliminarlo igualmente?</label>
											  
												 <div class="col-md-4 text-right">  
													 <div class="checkbox-color checkbox-danger">
														<input id="checkbox2_<?= $i ?>" type="checkbox" required="required" name="borraGrupo" value="<?= $grupo['IdGrupo'] ?>">
														  <label for="checkbox2_<?= $i ?>" class="form-control-label text-danger">Confirmar</label>
													 </div>

													<button type="submit" class="btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Si eliminas este grupo, el resto de miembros no podrán disfrutar de estas actividades relacionadas.">Eliminar</button>
												 </div>											  
											  
											  
												  <?php else: ?>
													 <label for="example-text-input" class="col-md-6 col-form-label form-control-label">¿Eliminar el grupo " <?= $grupo['Nombre'] ?> " ?</label>

												 <div class="col-md-4 text-right">  
													 <div class="checkbox-color checkbox-danger">
														<input id="checkbox2_<?= $i ?>" type="checkbox" required="required" name="borraGrupo" value="<?= $grupo['IdGrupo'] ?>">
														  <label for="checkbox2_<?= $i ?>" class="form-control-label text-danger">Confirmar</label>
													 </div>

													<button type="submit" class="btn btn-danger waves-effect waves-light">Eliminar</button>
												 </div>											  

											  
											  
											  <?php endif;?>											

										  </div>
										</form>	

									</div>								
									
								</td>
							 </tr>
						 
						<?php $i++; endforeach;
					  		endif;?>

                         </tbody>
                        </table>

                      </div>
                     </div>
                    </div>
                </div>				
				
				
				
				
               <div class="col-xl-5 col-lg-12">
                  <div class="card">
                    <div class="addCardCrearGrupo">
                      <div class="card-header">
                        <h5 class="card-header-text">Crear Grupo</h5>
                      </div>
						
                        <div class="card-block">
						
						<?php if(empty($contactos)):?>
							
						   <div style="text-align: center;">
							 <span style="font-size: 100px; color: #3D505A;" ><i class="icofont icofont-users-social "></i></span>
							 <h3> Añade contactos para poder a empezar a crear grupos de astronautas. </h3>			
						   </div>
						   </br>
						   <div class="col-md-12 text-center">
							  <form action="../views/contactos.php">
								<button class="btn btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Pulse para ir a al apartado de crear/administrar actividades" type="submit"> 
								Añadir Contactos
								</button>
							  </form>	
						   </div>
						<?php else:?>	
							
                        	<form action="../controller/admGruposController.php" method="post">
							   
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-md-2 col-form-label form-control-label">Nombre</label>
                                 <div class="col-md-10">
                                    <input class="form-control" type="text" name="nuevoGrupo" placeholder="Nombre del grupo" required>
                                 </div>
                              </div>
								<!-- Si se quiere cambiar algo de select ir a assets/pages/advance-form.js o a assets/plugins/multiselect/css/multi-select.css-->
                              <div class="row form-group">
							  	<label  class="col-md-2 col-form-label form-control-label">Integrantes</label>
								<div class="col-md-10">
									<select class="searchable" multiple='multiple' name="integrantesNuevoGrupo[]" required>
										
									<?php foreach ($contactos as $contacto): ?>
									  <option value='<?= $contacto['IdUsu'] ?>' > <?=  $contacto['Nombre'] ?> </option>                     
									<?php endforeach; ?>   
										
									</select>
								</div>
							  </div>
							   
                              <div class="row">
								 <div class="col-md-6 col-xs-6 col-form-label form-control-label"> 
									 
								  <?php if( !empty($_GET['res']) && $_GET['res'] == 1):?>
								 	<label class="text-success" > Grupo creado correctamente.</label>
								  <?php endif; ?>
									 
								 </div>
                                 <div class="col-md-6 col-xs-6 text-right" >
                                    <button type="submit" class="btn btn-info btn-md waves-effect waves-light">Crear</button>
								 </div>
                              </div>						  
							   
							   
                            </form>
						
						<?php endif;?>
						
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

 <script type="text/javascript" src="../assets/plugins/multi-select/js/jquery.quicksearch.js"></script>



</body>

</html>
