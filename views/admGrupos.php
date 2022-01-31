
<?php
include '..\controller\sessionBean.php';
include '..\model\bdConnection.php';
$s = new SessionBean();
$q = new LibraryQueries();

  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

require '..\views\templates\header2.html';
require '..\views\templates\navbar.html';
//require '..\views\templates\rest.html';

?>

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

               <div class="col-lg-6">
                  <div class="card">
                    <div class="addCardCrearGrupo">
                      <div class="card-header">
                        <h5 class="card-header-text">Crear Grupo</h5>
                      </div>
                        <div class="card-block">
                           <form action="../controller/admGruposController.php" method="post">
                              <div class="form-group row">
                                 <label for="example-text-input" class="col-xs-2 col-form-label form-control-label">Nombre</label>
                                 <div class="col-sm-10">
                                    <input class="form-control" type="text" name="nuevoGrupo" placeholder="Nombre del grupo" required>
                                 </div>
                              </div>
								<!-- Si se quiere cambiar algo de select ir a assets/pages/advance-form.js o a assets/plugins/multiselect/css/multi-select.css-->
                              <div class="form-group row">
                                 <label  class="col-xs-2 col-form-label form-control-label">Integrantes</label>
                                    <div class="col-sm-10">	
										<select class="searchable" multiple='multiple' name="integrantesNuevoGrupo[]" required>
											
										<?php foreach ($q -> getNombreContactos($IdUsu) as $contacto): ?>
											<option value='<?= $contacto['IdUsu'] ?>' > <?=  $contacto['Nombre'] ?> </option>											
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
								  
                                <div class="col-xs-2 offset-xs-10">
                                  <button type="submit" name="submitted" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Crear</button>
                                </div>
							<?php endif; ?>

                              </div>							  
							   
							   
                           </form>
                          </div>

                    </div>





                            <div id="card3" style="min-height: 0px; margin: 0 auto"></div>
                  </div>
                </div>



 
               <div class="col-xl-6">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Borrar/Modificar Grupo</h5>
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
							 
						<?php $i = 0; foreach (($q -> getGruposUsuario($IdUsu)) as $grupo): ?>
                            
							<tr>
								<td> <?= $grupo['Nombre'] ?> </td>

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
										
										<form action="../controller/admGruposController.php" method="post">
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-3 col-form-label form-control-label">Nuevo Nombre</label>
											 <div class="col-sm-6">
												<input class="form-control" type="text" name="modificarGrupo" placeholder="<?= $grupo['Nombre'] ?>" value="<?= $grupo['Nombre'] ?>" >
											 </div>
											  
										  </div>
											  
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-3 col-form-label form-control-label">Modificar Integrantes</label>
											 <div class="col-sm-6">
												 <!-- Pequeño problema. Id es único y por lo tanto en js de advance-form.js hay que poner una línea de id.-->
												<select class="form-control" id="example-multiple-selected<?= $i ?>" name="integrantesModificarGrupo[]" multiple="multiple" required>								   	
													<?php $j = 0; $integrante = $q -> getIntegrantesGrupo($grupo['IdGrupo'], $IdUsu);
														  foreach ($q -> getNombreContactos($IdUsu) as $contacto): 
									
														   if ( $contacto['IdUsu'] != $integrante[$j]['IdUsu'] ): ?>
													
																<option value="<?= $contacto['IdUsu'] ?>"> <?= $contacto['Nombre'] ?></option>
													
													 <?php else: ?>	
													
																<option id ="op_<?= $i ?>" value="<?= $contacto['IdUsu'] ?>" selected> <?= $contacto['Nombre'] ?> </option>		
													
													<?php  $j++; 
														  endif; endforeach; ?>
													
												</select>
											 </div>
											 
											 <button type="submit" class="btn btn-success waves-effect waves-light" name="idGrupo" value="<?= $grupo['IdGrupo'] ?>">Aplicar</button>
										  </div>
										</form>								   
	   
									</div>
								   
							   		<!-- Collapse con la Actividad a Eliminar -->								
									<div id="collapseTwo_<?= $i ?>" class="collapse show"  >
										
										<form action="../controller/admGruposController.php" method="post">
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-6 col-form-label form-control-label">¿Eliminar el grupo " <?= $grupo['Nombre'] ?> " ?</label>
											  
											 <div class="checkbox-color checkbox-danger">
											  <input id="checkbox_<?= $i ?>" type="checkbox" required="required" name="borraGrupo" value="<?= $grupo['IdGrupo'] ?>">
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


<?php require '..\views\templates\footer2.html'; ?>
