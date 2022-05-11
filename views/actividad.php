<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\eventoDB.php';
include '..\model\actividadDB.php';
$s = new SessionBean();
$g = new GenericDB();
$e = new EventoDB();
$a = new ActividadDB();
  
  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

	$actividad = $a -> getActividad($_GET['act']);

?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title> <?= $actividad[0]['Nombre'] ?> - TimesUpp </title>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php require 'templates/GeneralCss.html';?>
	
   <!-- Evo Calendar -->	
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.css" />
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.midnight-blue.css" />
   <link rel="stylesheet" href="../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" />
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	
	
   <!-- Kanban Menu -->	
   <link rel="stylesheet" href="../assets/plugins/kanban/css/kanban-main.css" />
	
	
	
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
                  <h4> <?= $actividad[0]['Nombre'] ?> </h4>
               </div>
            </div>
            
            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-xl-12 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Menu de tareas: <?= $actividad[0]['Nombre'] ?></h5>
                     </div>

                    <div class="CardB2-responisve">
                     <div class="card-block">
						
						<div class="kanban"></div>
			
                     </div>
                  </div>
					  
                </div>
              </div>				
				
				
               <div class="col-xl-9 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Calendario: <?= $actividad[0]['Nombre'] ?></h5>
                     </div>

                    <div class="CardB1-responisve">
                     <div class="card-block">
						

						<div id="calendar"></div>


			
                     </div>
                  </div>
					  
                </div>
              </div>


               <div class="col-xl-3 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Añadir Evento a <?= $actividad[0]['Nombre'] ?></h5>
                     </div>

                       
                     <div class="CardM2-responsive">
					  <div class="card-block">
					   <form action="../controller/indexController.php" method="post">

						  <div class="form-group row">
							 <label for="h-nombre" class="col-md-3 col-form-label form-control-label">Nombre</label>
							 <div class="col-md-9">
								<input type="text" id="h-nombre" name="eventoNombre" class="form-control" placeholder="Nombre del Evento" required>
							 </div>
						  </div>

						  <div class="form-group row">
							 <label for="h-nombre" class="col-md-3 col-form-label form-control-label">Etiqueta</label>
							 <div class="col-md-9">
								<input type="text" id="h-nombre" name="eventoEtiqueta" class="form-control" placeholder="Etiqueta" required>
							 </div>
						  </div>
						   
						  <div class="form-group row">
							 <label for="h-desc" class="col-md-3 col-form-label form-control-label">Descripción</label>
							 <div class="col-md-9">
								<textarea class="form-control max-textarea" id="h-desc" name="eventoDescrip" rows="4" maxlength="200" placeholder="Descripción"></textarea>
							 </div>
						  </div>
						   
						  <div class="form-group row">
							 <label class="col-md-3 col-form-label form-control-label">Añadir a</label>
							 <div class="col-md-9">
								<select class="form-control" name="eventoActividad" id="eventoActividad" required>
									<option value="" selected>Ninguno</option>
									
									<?php foreach(($g -> getActividadesUsuario($IdUsu)) as $actividad ):?>
										<option value="<?= $actividad['IdAct'] ?>"> <?= $actividad['Nombre'] ?> </option>	
									<?php endforeach; ?>
									
								</select>
							 </div>
						  </div>
						
						  <div class="form-group row">
							<label for="h-nombre" class="col-md-4 col-form-label form-control-label">Fecha Inicial</label>
							<div class="col-md-8">  
								<input type="text" name="eventoFecha1" class="date form-control floating-label" placeholder="YYYY-MM-DD" required>
							</div>
						  </div> 
						   
						  <div class="form-group row">
							<label for="h-nombre" class="col-md-4 col-form-label form-control-label">Fecha Final</label>
							<div class="col-md-8">  
								<input type="text" name="eventoFecha2" class="date form-control floating-label" placeholder="YYYY-MM-DD">
							</div>
						  </div> 
						   				   
						  <div class="form-group row">
							  
						 	<div class="col-md-4 col-xs-4">
								<label for="chkcustom" class="form-control-label">Evento Grupal</label>
							</div>
						    <div class="col-md-2 col-xs-2">
								<label class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="eventoGrupal" id="eventoGrupal" disabled>
									<span class="custom-control-indicator"></span>
								</label>
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

               <div class="col-xl-3 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Actividades</h5>
                     </div>

                      <div class="CardS2">

                        <div class="card-block button-list">

						<?php foreach (($g -> getActividadesUsuario($IdUsu)) as $actividad): ?>

							<button type="button" class="btn btn-info btn-block waves-effect" data-toggle="tooltip" data-placement="top" title="Pulse para ir a al apartado de la actividad"> 
							<?= $actividad['Nombre'] ?>
							</button>
							
 						<?php endforeach; ?>

                           <button type="button" class="btn btn-info btn-block waves-effect" data-toggle="tooltip" data-placement="top" title=".btn-info .btn-block"> Primera Opcion
                                </button>
                           <button type="button" class="btn btn-inverse-info btn-block waves-effect" data-toggle="tooltip" data-placement="top" title=".btn-inverse-info ">Segunda Opcion
                                </button>

                        </div>


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

 	<?php require 'templates/generalJs.html';?>
 	<?php require '../assets/plugins/evocalendar/php/actCalendar.php';?>	

	<!-- Kanban Menu -->
	<script type="text/javascript"> var act = <?= $_GET['act'];?> </script>
	<script type="module" src="../assets/plugins/kanban/js/kanban-main.js"></script>	
	
   <!-- Evo Calendar -->		
	<script type="text/javascript" src="../assets/plugins/evocalendar/js/evo-calendar.js"></script>
	<script>
	  function ajaxCall(id){
    
		  var url = "../assets/plugins/evocalendar/php/borrarEvento.php";
		  var params = "somevariable=somevalue&anothervariable=anothervalue";
		  var http = new XMLHttpRequest();

		  http.open("GET", url+"?"+"id="+id, true);
		  http.onreadystatechange = function()
		  {
			if(http.readyState == 4 && http.status == 200) {
			  console.log(http.responseText);
			}
		  }
		  http.send(null)

	  } 	
	</script>
</body>

</html>
