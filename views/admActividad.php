<?php
include '..\controller\sessionBean.php';
include '..\model\bdConnection.php';
$s = new SessionBean();
$q = new LibraryQueries();

  $IdUsu = $s -> getIdActualUsuario();

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
                  <h4>Acciones sobre Actividad</h4>
               </div>
            </div>

            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-lg-6">
                  <div class="card">
                    <div class="addCardCrearActividad">
                      <div class="card-header">
                        <h5 class="card-header-text">Crear Actividad</h5>
                      </div>
                        <div class="card-block">
                           <form action="../controller/admActividadController.php" method="post">
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-xs-2 col-form-label form-control-label">Nombre</label>
                                 <div class="col-sm-10">
                                    <input class="form-control" type="text" name="nuevaActividad" placeholder="Nombre de la actividad" required="required">
                                 </div>
                              </div>

                              <div class="form-group row">
                                 <label for="exampleSelect1" class="col-xs-2 col-form-label form-control-label">Grupo</label>
                                    <div class="col-sm-10">
                                        <select class="form-control " name="grupoNuevaActividad" id="Grupo">
                                            <option value="Ninguno">Ninguno</option>
											
											<?php foreach (($q -> getGruposUsuario($IdUsu)) as $grupo): ?>
											
                                            	<option value="<?= $grupo['IdGrupo'] ?>"> <?= $grupo['Nombre'] ?> </option>
                                              
											<?php endforeach; ?>
											
                                        </select>
                                    </div>
                              </div>

                              <div class="form-group row">
							  
							  <?php if( !empty($_GET['res']) && $_GET['res'] == 1):?>

								<div class="col-xs-4 offset-xs-6 col-form-label form-control-label">                    
								  <label class="text-success"> Actividad creada correctamente.
								  </label>
								</div>

								<div class="col-xs-2 offset-xs-0">                                  
								  <button type="submit" name="submitted" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Crear</button>
								</div>
							
                    		  <?php else: ?>
	                            <div class="col-xs-2 offset-xs-9">							    
									<div class="card-block button-list notifications">

										<a href="#!" class="btn btn-info waves-effect " data-type="inverse" data-from="bottom" data-align="left">Crea Prox</a>
									</div>
                                </div>
								  
                                <div class="col-xs-2 offset-xs-10">
                                  <button type="submit" name="submitted" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Crear</button>
                                </div>
							<?php endif; ?>

                              </div>							  
							   
							   
                           </form>
                          </div>

                    </div>




							<!-- Aumenta los px para crear un espacio en blanco-->	
                            <div id="card3" style="min-height: 0px; margin: 0 auto"></div>
                  </div>
                </div>



 
               <div class="col-xl-6">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Borrar/Modificar Actividad</h5>
                     </div>
						
                      <div class="addCardModificarBorrarActividad">
                        <div class="card-block">
                        <table class="table table-hover" >
                         <thead>
                            <tr>
                               <th>Actividad</th>
                               <th>Modificar</th>
                               <th>Borrar</th>
                            </tr>
                         </thead>
                         <tbody>
							 
						<?php $i = 0; foreach (($q -> getActividadesUsuario($IdUsu)) as $actividad): ?>
                            
							<tr>
								<td> <?= $actividad['Nombre'] ?> </td>

								<td> <button class="btn btn-info waves-effect" data-toggle="collapse" data-target="#collapseOne_<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
									 <i class="icon-note"></i></button>
								</td>	

								<td> <button class="btn btn-danger waves-effect" data-toggle="collapse" data-target="#collapseTwo_<?= $i ?>" aria-expanded="true">
									 <i class="icon-trash icon-white"></i></a>
								</td>
								

							</tr>
							 
							<tr>
								<td colspan=3>
									
									<!-- Collapse con la Actividad a Modificar -->
									<div id="collapseOne_<?= $i ?>" class="collapse show"  >
										
										<form action="../controller/admActividadController.php" method="post">
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-3 col-form-label form-control-label">Nuevo Nombre</label>
											 <div class="col-sm-6">
												<input class="form-control" type="text" name="modificarActividad" placeholder="<?= $actividad['Nombre'] ?>" value="<?= $actividad['Nombre'] ?>" >
											 </div>
											  
										  </div>
											  
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-3 col-form-label form-control-label">Nuevo Grupo</label>
											 <div class="col-sm-6">
												<select class="form-control " name="grupoModificarActividad" id="Grupo">
													<option value="Ninguno" >Ninguno</option>

													<?php foreach (($q -> getGruposUsuario($IdUsu)) as $grupo): 
															if (($q -> getIdGrupoActividad($actividad['IdAct'])) != $grupo['IdGrupo']): ?>

																<option value="<?= $grupo['IdGrupo'] ?>" > <?= $grupo['Nombre'] ?> </option>
															
													  <?php else: ?>
													
																<option value="<?= $grupo['IdGrupo'] ?>" selected> <?= $grupo['Nombre'] ?> </option>
														
													<?php endif; endforeach; ?>

												</select>
											 </div>											  
											  
											 <button type="submit" class="btn btn-success waves-effect waves-light" name="idActividad" value="<?= $actividad['IdAct'] ?>">Aplicar</button>
										  </div>
										</form>								   
	   
									</div>
								   
							   		<!-- Collapse con la Actividad a Eliminar -->								
									<div id="collapseTwo_<?= $i ?>" class="collapse show"  >
										
										<form action="../controller/admActividadController.php" method="post">
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-6 col-form-label form-control-label">¿Eliminar la actividad " <?= $actividad['Nombre'] ?> " ?</label>
											  
											 <div class="checkbox-color checkbox-danger">
											  <input id="checkbox_<?= $i ?>" type="checkbox" required="required" name="borraActividad" value="<?= $actividad['IdAct'] ?>">
												  <label for="checkbox_<?= $i ?>" class="form-control-label text-danger">Confirmar</label>
											 </div>

											 <button type="submit" class="btn btn-danger waves-effect waves-light">Eliminar</button>
										  </div>
										</form>	

									</div>								
									
								</td>
							 </tr>
						 
						<?php $i++; endforeach; ?>

                         </tbody>
                        </table>

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


<?php require '..\views\templates\footer3.html'; ?>

