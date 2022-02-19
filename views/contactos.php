<?php
include '..\controller\sessionBean.php';
include '..\model\usuarioDB.php';
include '..\model\genericDB.php';
$s = new SessionBean();
$g = new GenericDB();
$u = new usuarioDB();

	$IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])):
    	header('Location: ..\views\login.php');  
	endif;
	
	$contactosEntrantes = $u -> getContactosPendientesEntrantes($IdUsu);
	$contactoSalientes = $u -> getContactosPendientesSalientes($IdUsu);
	$contactos = $u -> getContactos($IdUsu);

require '..\views\templates\header.html';
require '..\views\templates\navbar.html';

?>

      <!-- Dashboard Start -->
      <div class="content-wrapper">
         <!-- Container-fluid starts -->
         <!-- Main content starts -->
         <div class="container-fluid">
            <div class="row">
               <div class="main-header">
                  <h4>Contactos</h4>
               </div>
            </div>

            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-lg-7">
                  <div class="card">         
					  <div class="card-header">
						<h5 class="card-header-text">Tus contactos</h5>
					  </div>
						<div class="CardB1">
                        <div class="card-block">
							
						<?php if ( empty($contactos) ): ?>
						 
						 <div id="blank" style="min-height: 50px; margin: 0 auto"></div>
						 <div style="text-align: center;">
						  <span style="font-size: 200px; color: #3D505A;" ><i class="icofont icofont-users-social "></i></span>
						  <h3>Estaba organizando mis tareas de hoy, pero no he podido evitar ver que no tienes ningún contacto aún. ¿A que esperas?</h3>			
						 </div>

						<?php else:?>
							
                        <table class="table table-hover" >
                         <thead>
                            <tr>
							   <th>Usuario</th>
							   <th>Más Información</th>
                               <th>Eliminar</th>
                            </tr>
                         </thead>
                         <tbody>
							 
						<?php $i = 0; foreach ( $contactos as $contacto): ?>
                            
							<tr>
								<td> 
									<div class="col-md-4 col-xs-12 text-left">
										<span><img class="img-contactos" src="<?= $contacto['Foto'] ?>" alt="User Image"></span>
									</div>
									
									<label class="col-md-8 col-xs-12 col-form-label form-control-label" style="margin-top: 5%"> <?= $contacto['Nombre'] ?> </label>
									
								</td>	

								<td></br> 
									<button class="offset-xs-2 btn btn-info btn-icon waves-effect waves-light " data-toggle="collapse" data-target="#collapseOne_<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
									 <i class="icon-plus"></i></button>
								</td>	


								<td></br> 
									<button class="btn btn-danger btn-icon waves-effect waves-light" data-toggle="collapse" data-target="#collapseTwo_<?= $i ?>" aria-expanded="true">
									 <i class="icon-trash icon-white"></i></a>
								</td>
								

							</tr>
							 
							<tr>
								<td colspan=3>

									<!-- Collapse con Más Información -->
									<div id="collapseOne_<?= $i ?>" class="collapse show"  >
										
                                        <label class="offset-xs-1 form-control-label">Información </label>
                                        <br/>

										<div class="card-block row box-list">

											<div class="col-lg-9">
												<div class="p-20 z-depth-left-0 waves-effect" data-toggle="tooltip" data-placement="top" title="Email">
													<p class="text-sm-center"><?= $contacto['Email'] ?></p>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="p-20 z-depth-left-3 waves-effect" data-toggle="tooltip" data-placement="top" title="Usuario">
													<p class="text-sm-center "><?= $contacto['Usuario'] ?></p>
												</div>
											</div>

										</div>										

									</div>									
															   
							   		<!-- Collapse con el Contacto a Eliminar -->								
									<div id="collapseTwo_<?= $i ?>" class="collapse show"  >
										
										<form action="../controller/contactosController.php" method="post">
											
										  <div class="form-group row">
										  	<div class="col-md-5">
												<label class="form-control-label">¿Desea eliminar de tus contactos a " <?= $contacto['Nombre'] ?> " ?</label>
											</div>
											  
											<div class="col-md-4 text-right">
											  <div class="checkbox-color checkbox-danger" align="center">
											  	<input id="checkbox_<?= $i ?>" type="checkbox" required="required" name="borraContacto" value="<?= $contacto['IdUsu'] ?>">
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



 
               <div class="col-xl-5">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Añadir nuevo contacto</h5>
                     </div>
					 	<div class="CardS1">
                        <div class="card-block">

							<form action="../controller/contactosController.php" method="post">
								
								<div class="form-group row">
									<label for="nuevoContacto" class="col-md-4 col-form-label form-control-label">Nombre del Usuario</label>
									<div class="col-md-8">
										<input id="nuevoContacto" name="nuevoContacto" type="text" class="form-control"  placeholder="Usuario" data-toggle="tooltip" title="Introduce el 'Usuario' para poder añadir a esa persona a tu lista de contactos" required>
									</div>
								</div>
								
								<div class="form-group row">
									
								 <div class="col-md-8 col-xs-6 col-form-label form-control-label">
									 
								  <?php if (!empty($_GET['contacto'])):
									 switch ($_GET['contacto']):
									 case -1:?>  
									 
									  <label class="text-danger"> El usuario que ha introducido no existe.</label>
									 
							      <?php break;
									 case -2: ?>
									                    
									  <label class="text-warning"> El usuario introducido ya tiene una petición pendiente.</label>

							      <?php break;
									 case -3: ?>
								 
									  <label class="text-warning"> El usuario ya está en tu lista de contactos.</label>

							      <?php break;
									 case 1: ?>
                 
									  <label class="text-success"> La Solicitud ha sido enviada.</label>

								  <?php break;
									 endswitch;
									 endif;?>
									 
        						 </div>	
									
								 <div class="col-md-4 col-xs-6 text-right">	
									<button type="submit" class="btn btn-info waves-effect waves-light">Añadir</button>
								 </div>
								</div>
								
							</form>							

						</div>
				   	  </div>
                    </div>
                </div>

				
               <div class="col-xl-5 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Peticiones Pendientes</h5>
                     </div>

                      <div class="CardM1">
                        <div class="card-block">
						 	
							<!-- Incio de las Tabs -->
							<ul class="nav nav-tabs md-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tabEntrante" role="tab">Entrantes</a>
									<div class="slide"></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabSaliente" role="tab">Salientes</a>
									<div class="slide"></div>
								</li>
							</ul>

							<!-- Contenido de las Tabs -->
							<div class="tab-content">
								
							  <div class="tab-pane active" id="tabEntrante" role="tabpanel">
								 
								<?php if ( empty($contactosEntrantes) ): ?>

								 <div style="text-align: center;">
								  <span style="font-size: 150px; color: #3D505A;" ><i class="icon-ghost"></i></span>
								  <h3 >Actualmente no has recibido ninguna petición para hacer nuevos contactos.</h3>			
								 </div>

								<?php else:?>

										<div class="row">
										   <div class="col-sm-12 table-responsive">
											  <table class="table">
												 <thead>
													<tr>
													   <th>#</th>
													   <th>Usuario</th>
													   <th>Nombre</th>
													   <th>Acciones</th>
													</tr>
												 </thead>
												 <tbody>

												 <?php  $i = 0; foreach ( $contactosEntrantes as $contactoEntrante): ?> 
													<tr>

													   <td><?= $i+1 ?> </td>
													   <td> <?= $contactoEntrante['Usuario'] ?> </td>
													   <td> <?= $contactoEntrante['Nombre'] ?> </td>
													   <td>
														 <form class="form-inline" action="../controller/contactosController.php" method="post">

														   <button type="submit" class="btn btn-success btn-icon waves-effect waves-light" name="idContactoAceptar" value="<?= $contactoEntrante['IdUsu'] ?>">
															<i class="icon-check"></i>
														   </button>
														   <button type="submit" class="btn btn-danger btn-icon waves-effect waves-light" name="idContactoRechazar" value="<?= $contactoEntrante['IdUsu'] ?>">
															<i class="icon-close"></i>
														   </button>

														 </form>
													   </td>

													</tr>
												 <?php $i++; endforeach; ?>

												 </tbody>
											  </table>
										   </div>
										</div>

								<?php endif; ?>								 

							  </div>
								
							  <div class="tab-pane" id="tabSaliente" role="tabpanel">
								<?php if ( empty($contactoSalientes) ): ?>

								 <div style="text-align: center;">
								  <span style="font-size: 150px; color: #3D505A;" ><i class="icon-ghost"></i></span>
								  <h3 >Actualmente no tienes ninguna petición enviada pendiente a ser respondida.</h3>			
								 </div>

								<?php else:?>

										<div class="row">
										   <div class="col-md-12 table-responsive">
											  <table class="table">
												 <thead>
													<tr>
													   <th>#</th>
													   <th>Usuario</th>
													   <th>Estado</th>
													</tr>
												 </thead>
												 <tbody>

												 <?php  $i = 0; foreach ($contactoSalientes as $contactoSaliente): ?> 
													<tr>

													   <td> <?= $i+1 ?> </td>
													   <td> <?= $contactoSaliente['Usuario'] ?> </td>
													   <td>Pendiente confirmación de "<?= $contactoSaliente['Nombre'] ?>" .</td>

													</tr>
												 <?php $i++; endforeach; ?>

												 </tbody>
											  </table>
										   </div>
										</div>

								<?php endif; ?>
						
							  </div>
								
							</div>						
							<!-- Fin de las Tabs -->
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


<?php require '..\views\templates\footer.html'; ?>
