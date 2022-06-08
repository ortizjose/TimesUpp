<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
include '..\model\eventoDB.php';
$s = new SessionBean();
$g = new GenericDB();
$e = new EventoDB();
  
  $IdUsu = $s -> getIdActualUsuario();
  $Usuario = $g -> getUsuario($IdUsu);

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title> Dashboard - TimesUpp </title>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php require 'templates/GeneralCss.html';?>
	
   <!-- Evo Calendar -->	
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.css" />
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.midnight-blue.css" />
   <link rel="stylesheet" href="../assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" />
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	
	
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

                    <div class="CardB1-responsive">
                     <div class="card-block">
						
						<div id="calendar"></div>


			
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
                        <h5 class="card-header-text">Nota Rápida</h5>
                     </div>

                      <div class="CardS2">

                        <div class="card-block">
							<textarea id="notaRapida" class="form-control dark-text-area" rows="6" maxlength="288" data-toggle="tooltip" title="Añada la anotación rápida que desee."><?= $Usuario[0]['NotaRapida'] ?> </textarea>
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
 	<?php require '../assets/plugins/evocalendar/php/indexCalendar.php';?>	
	
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
	
	  //Eventos Nota Rapida
	  var contNota;
	  document.getElementById("notaRapida").addEventListener("mouseenter", () => {
		  
		  contNota = document.getElementById("notaRapida").value;	  
	  });	
					
	  document.getElementById("notaRapida").addEventListener("mouseleave", () => {
		  
		  
		  if ( contNota != document.getElementById("notaRapida").value ) {
			  
			  var url = "../controller/indexController.php";
			  var http = new XMLHttpRequest();

			  http.open("GET", url+"?cambio=1"+"&nota="+document.getElementById("notaRapida").value, true);
			  http.onreadystatechange = function()
			  {
				if(http.readyState == 4 && http.status == 200) {

				}
			  }
			  http.send(null)			  
			 
		  }
  	  
	  });	
		
		
	</script>
</body>

</html>
