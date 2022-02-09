<?php
include '..\controller\sessionBean.php';
include '..\model\usuarioDB.php';
include '..\model\bdConnection.php';
$s = new SessionBean();
$u = new usuarioDB();
$q = new LibraryQueries();

  	$IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

	$usuario = $u -> getUsuario($IdUsu);

require '..\views\templates\header2.html';
require '..\views\templates\navbar.html';

?>

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
                    <div class="addCardTareas">
                      <div class="card-header text-center">
                        <h4 class="card-header-text-2"> <?= $usuario[0]['Nombre']?> </h4>
                      </div>
						
                        <div class="card-block">
							<div class="text-center">
							<span><img class="img-circle " src="../assets/images/avatar-6.png" style="width:200px;" alt="User Image"></span> 
							</div>
							<div class="card-block row box-list text-center">
								<!-- Start a Box p-20 -->
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-0 waves-effect" data-toggle="tooltip" data-placement="top" title="Email">
										<p class="text-sm-center"> <?= $usuario[0]['Usuario']?> </p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-1 waves-effect" data-toggle="tooltip" data-placement="top" title=".z-depth-left-1">
										<p class="text-sm-center "> <?= $usuario[0]['Email']?> </p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-2 waves-effect" data-toggle="tooltip" data-placement="top" title=".z-depth-left-2">
										<p class="text-sm-center">Numero de Grupos</p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-3 waves-effect" data-toggle="tooltip" data-placement="top" title=".z-depth-left-3">
										<p class="text-sm-center">Numero de Actividades</p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-4 waves-effect" data-toggle="tooltip" data-placement="top" title=".z-depth-left-4">
										<p class="text-sm-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="p-20 z-depth-left-5 waves-effect" data-toggle="tooltip" data-placement="top" title=".z-depth-left-5">
										<p class="text-sm-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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
                        <h5 class="card-header-text">Añadir nuevo contacto</h5>
                     </div>
					  
                        <div class="card-block">

							<form class="form-inline" action="../controller/contactosController.php" method="post">
								<div class="form-group">
									<label for="nuevoContacto" class="form-control-label">Nombre del Usuario</label>
										<input id="nuevoContacto" name="nuevoContacto" type="text" class="form-control"  placeholder="Usuario" data-toggle="tooltip" title="Introduce el 'Usuario' para poder añadir a esa persona a tu lista de contactos" required>
								</div>
								<div class="form-check">
									<button type="submit" class="btn btn-success waves-effect waves-light">Añadir</button>
								</div>
								 <div class="form-group">
									 
								  <?php if( !empty($_GET['contacto']) && $_GET['contacto'] == -1):?>

								 	<div class="col-form-label form-control-label">                    
									  <a class="text-danger"> El usuario que ha introducido no existe.</a>
									</div>
									 
							      <?php elseif(!empty($_GET['contacto']) && $_GET['contacto'] == -2): ?>
									 
								 	<div class="col-form-label form-control-label">                    
									  <a class="text-warning"> El usuario introducido ya tiene una solicitud.</a>
									</div>	
									 
							      <?php elseif(!empty($_GET['contacto']) && $_GET['contacto'] == -3): ?>

								 	<div class="col-form-label form-control-label">									 
									  <a class="text-warning"> El usuario ya está en tu lista de contactos.</a>
									</div>
									 
							      <?php elseif(!empty($_GET['res']) && $_GET['res'] == 1): ?>
										
								 	<div class="col-form-label form-control-label">                   
									  <a class="text-success"> La Solicitud ha sido enviada.</a>
									</div>
									 
								  <?php else: ?>
									 <!-- Aumenta los px para crear un espacio en blanco-->	
                            		<div id="card3" style="min-height: 74px; margin: 0 auto"></div>
								  <?php endif; ?>
									 
        						 </div>
								
								
							</form>							

						</div>

                    </div>
                </div>

				
               <div class="col-xl-5 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Peticiones Pendientes</h5>
                     </div>

                      <div class="addCardContactosPendientes">
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
								 
								<?php if ( !($u -> getContactosPendientesEntrantes($IdUsu)) ): ?>

								 <div style="text-align: center;">
								  <span style="font-size: 150px; color: #3D505A;" ><i class="icon-ghost"></i></span>
								  <h3 >Actualmente no tienes ninguna petición entrante pendiente de nuevos contactos.</h3>			
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

												 <?php  $i = 0; foreach (($u -> getContactosPendientesEntrantes($IdUsu)) as $contactopendiente): ?> 
													<tr>

													   <td><?= $i+1 ?> </td>
													   <td> <?= $contactopendiente['Usuario'] ?> </td>
													   <td> <?= $contactopendiente['Nombre'] ?> </td>
													   <td>
														 <form class="form-inline" action="../controller/contactosController.php" method="post">

														   <button type="submit" class="btn btn-success btn-icon waves-effect waves-light" name="idContactoAceptar" value="<?= $contactopendiente['IdUsu'] ?>">
															<i class="icon-check"></i>
														   </button>
														   <button type="submit" class="btn btn-danger btn-icon waves-effect waves-light" name="idContactoRechazar" value="<?= $contactopendiente['IdUsu'] ?>">
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
								<?php if ( !($u -> getContactosPendientesSalientes($IdUsu)) ): ?>

								 <div style="text-align: center;">
								  <span style="font-size: 150px; color: #3D505A;" ><i class="icon-ghost"></i></span>
								  <h3 >Actualmente no tienes ninguna petición saliente pendiente a ser respondida.</h3>			
								 </div>

								<?php else:?>

										<div class="row">
										   <div class="col-sm-12 table-responsive">
											  <table class="table">
												 <thead>
													<tr>
													   <th>#</th>
													   <th>Usuario</th>
													   <th>Estado</th>
													</tr>
												 </thead>
												 <tbody>

												 <?php  $i = 0; foreach (($u -> getContactosPendientesSalientes($IdUsu)) as $contactopendienteres): ?> 
													<tr>

													   <td> <?= $i+1 ?> </td>
													   <td> <?= $contactopendienteres['Usuario'] ?> </td>
													   <td>Pendiente de ser respondida por "<?= $contactopendienteres['Nombre'] ?>" .</td>

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


<?php require '..\views\templates\footer2.html'; ?>
