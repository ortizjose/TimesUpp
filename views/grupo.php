<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\grupoDB.php';
include '..\model\actividadDB.php';
$s = new SessionBean();
$g = new GenericDB();
$gr = new grupoDB();
$a = new ActividadDB();


  	$IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

	$grupo = $gr -> getNombreGrupo($_GET['grupo']);
	$actividades = $a -> getActividadesGrupo($_GET['grupo']);

require '..\views\templates\header.html';
require '..\views\templates\navbar.html';

?>      <!-- Dashboard Start -->
      <div class="content-wrapper">
         <!-- Container-fluid starts -->
         <!-- Main content starts -->
         <div class="container-fluid">
            <div class="row">
               <div class="main-header">
                  <h4>Grupo</h4>
               </div>
            </div>
            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-lg-7">
                  <div class="card">
					  <div class="card-header text-center">
						<h4 class="card-header-text-2"> <?= $grupo[0]['Nombre']?> </h4>
					  </div>
					  
					   <div class="CardB1">
                         <div class="card-block">
							 
						 	<form id="formFotoPerfil" action="../controller/grupoController.php?grupo=<?= $_GET['grupo']?>" method="post" enctype="multipart/form-data">						 
								<div class="profile-pic">
									<img class="p-photo" src="<?= $grupo[0]['Foto']?>"> 
									<input type="file" class="p-file" id="fotoPerfil" name="fotoGrupo" accept=".jpg, .jpeg, .png">
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
							 </br> 
							<div class="card-block row box-list text-center">
								
							 <?php foreach($gr -> getIntegrantesGrupo($_GET['grupo']) as $integrante):?>

								<div class="col-lg-4">
									<div class="p-20 z-depth-left-0 waves-effect" data-toggle="tooltip" data-placement="top" title="Usuario">
										<p class="text-sm-center"> <?= $integrante['Nombre'] ?> </p>
									</div>
								</div>
								
							 <?php endforeach; ?>
								
							</div>
                      </div>
                  	</div>
					  
                  </div>
				</div>


				
               <div class="col-lg-5">
                  <div class="card">					  
				   <div class="card-header">
					<h5 class="card-header-text">Actividades del Grupo</h5>
				   </div>
				   	<div class="CardVS1">
                    	<div class="card-block">
							
						<?php if (empty($actividades)):  ?>	
							
							<div style="text-align: center;">
							 <span style="font-size: 100px; color: #3D505A;" ><i class="icofont icofont-children-care "></i></span>
							 <h3>¿Un grupo sin actividades? A no ser que estéis de vacaciones, debeis de ir creando alguna actividad.</h3>			
							</div>
							</br>
							<div class="col-md-12 text-center">
							  <form action="../views/admActividad.php">
								<button class="btn btn-info waves-effect" data-toggle="tooltip" data-placement="top" title="Pulse para ir a al apartado de crear/administrar actividades" type="submit"> 
								Crear Actividad
								</button>
							  </form>	
							</div>
							
						<?php else:
							foreach ( $actividades as $actividad): ?>
							
							<button type="button" class="btn btn-info btn-block waves-effect" data-toggle="tooltip" data-placement="top" title="Pulse para ir a al apartado de la actividad"> 
							<?= $actividad['Nombre'] ?>
							</button>
							
							
						<?php endforeach;
							endif; ?>

                        </div>
					</div>
				   
                  </div>
                </div>
				

            <!-- 2-1 block end -->
            </div>

         <!-- Main content ends -->
         <!-- Container-fluid ends -->

      </div>
   </div>


<?php require '..\views\templates\footer.html'; ?>
