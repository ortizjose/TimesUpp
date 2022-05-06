<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\eventoDB.php';
$s = new SessionBean();
$g = new GenericDB();
$e = new EventoDB();
  
  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}


//require '..\views\templates\header.html';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title> TimesUpp </title>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	
<!-- General CSS -->
   <!-- Favicon icon -->
   <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
   <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">
	
   <!-- Font Awesome -->
   <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- iconfont -->
	<link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	
   <!-- End General CSS -->	
   <script type="text/javascript" src="../assets/plugins/Jquery/dist/jquery.min.js"></script>
	
   <link rel="stylesheet" href="../assets/plugins/multiselect/css/multi-select.css" />
   <link rel="stylesheet" href="../assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" />
	
   <!-- Evo Calendar -->	
	<script type="text/javascript" src="../assets/plugins/evocalendar/js/evo-calendar.js"></script>
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.css" />
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.midnight-blue.css" />
   
   <link rel="stylesheet" href="../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" />
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	
</head>
	
<body class="sidebar-mini fixed">
   <div class="loader-bg">
      <div class="loader-bar">
      </div>
   </div>
	
<?php require '..\views\templates\navbarOK.html';	?>
	
      <!-- Dashboard Start -->
      <div class="content-wrapper">
         <!-- Container-fluid starts -->
         <!-- Main content starts -->
         <div class="container-fluid">
            <div class="row">
               <div class="main-header">
                  <h4>Dashboard</h4>
               </div>
            </div>
            
            <!-- 2-1 block start -->
            <div class="row">
               <div class="col-xl-9 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Calendario</h5>
                     </div>

                    <div class="CardB1-responisve">
                     <div class="card-block">
						
						<br/> 
						<div id="calendar"></div>
						 <br/>

			
                     </div>
                  </div>
					  
                </div>
              </div>


               <div class="col-xl-3 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Añadir Evento</h5>
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

   <!-- Generic JS for Theme -->

   <script type="text/javascript" src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
   <script type="text/javascript" src="../assets/plugins/tether/dist/js/tether.min.js"></script>

   <script type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="../assets/js/main.min.js"></script>

   <!-- Perfil JS -->
   <script type="text/javascript" src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
   <script type="text/javascript" src="../assets/pages/accordion.js"></script>	
	
   <!-- Bootstrap Datepicker js -->
   <script type="text/javascript" src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>
   <script type="text/javascript" src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>   
   <script>
	// initialize your calendar, once the page's DOM is ready
	$(document).ready(function() {
		
		$('#calendar').evoCalendar({
			theme: 'Midnight Blue',
			language: 'es',
			eventHeaderFormat: 'd MM yyyy',
			todayHighlight: true,
			firstDayOfWeek: 1
		});
	
		var eventos = [];
		
		<?php foreach ($e -> getEventos($IdUsu) as $evento ): 
			if ( empty ($evento['FechaFin'])):
		?>
		
		 eventos.push({ 
			id: "<?= $evento['IdEve'] ?>",
			name: "<?= $evento['Nombre'] ?>",
			description: "<?= $evento['Descripcion'] ?>",
			badge: "<?= $evento['Etiqueta'] ?>",
			date: "<?= $evento['Fecha'] ?>"  ,
			type: "birthday",
	
		} );
		
		<?php else: ?>
		
		 eventos.push({ 
			id: "<?= $evento['IdEve'] ?>",
			name: "<?= $evento['Nombre'] ?>",
			description: "<?= $evento['Descripcion'] ?>",
			badge: "<?= $evento['Etiqueta'] ?>",
			date: ["<?= $evento['Fecha'] ?>" ,"<?= $evento['FechaFin'] ?> " ] ,
			type: "event",
	
		} );
		
		<?php endif;
			 endforeach; ?>
		
		//console.log(eventos);
		
		$('#calendar').evoCalendar("addCalendarEvent", eventos);
		//$('#calendar').evoCalendar("removeCalendarEvent",'1');
	
		//Boton "Añadir a" habilita la opción de "Evento Grupal" cuando se selecciona una Actividad.
		document.getElementById("eventoActividad").onchange = function(){
			
			if ( Number( document.getElementById("eventoActividad").value ) )
				document.getElementById('eventoGrupal').disabled = false;
			else 
				document.getElementById('eventoGrupal').disabled = true;
	
		};
		
		/*const deleteEventButtons = document.getElementsByClassName('button-event-delete');
		
		for (let delEveBut of deleteEventButtons) {
			console.log(delEveBut);
			delEveBut.addEventListener('click', (event) => {
				
			console.log(event.target+" || "+delEveBut);	
				
			});
		*/	
		})
		
   </script>

   <!-- Scrollbar J	S-->
   <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    
   <!-- Date picker.js -->
   <script src="../assets/plugins/datepicker/js/moment-with-locales.min.js"></script>
   <script src="../assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

	
	
   <!-- Select 2 js -->
   <script src="../assets/plugins/select2/dist/js/select2.full.min.js"></script>

   <!-- Max-Length js -->
   <script src="../assets/plugins/bootstrap-maxlength/src/bootstrap-maxlength.js"></script>

   <!-- Multi Select js -->
   <script src="../assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
   <script src="../assets/plugins/multiselect/js/jquery.multi-select.js"></script>

   <!-- Tags js -->
   <script src="../assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>

   <!-- Bootstrap Datepicker js -->
    <script type="text/javascript" src="../assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>

    <!-- bootstrap range picker -->
    <script type="text/javascript" src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

   <!-- custom js -->
   <script type="text/javascript" src="../assets/pages/advance-form.js"></script>

	
	
</body>

</html>
