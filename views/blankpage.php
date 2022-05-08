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


?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title> TimesUpp </title>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php require 'templates/GeneralCss.html';?>
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.css" />
   <link rel="stylesheet" href="../assets/plugins/evocalendar/css/evo-calendar.midnight-blue.css" />

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
                  <h4>Grupo</h4>
               </div>
            </div>
            <!-- 2-1 block start -->
            <div class="row">

               <div class="col-lg-7">
                  <div class="card">
					  <div class="card-header text-center">
						<h4 class="card-header-text-2">Titulo 1 </h4>
					  </div>
					  
					   <div class="CardB1">
                         <div class="card-block">
						<br/> 
						<div id="calendar"></div>
						 <br/>
						 </div>
					  </div>
					  
                  </div>
				</div>


				
               <div class="col-lg-5">
                  <div class="card">					  
				   <div class="card-header">
					<h5 class="card-header-text">Actividades del Grupo</h5>
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
	<script type="text/javascript" src="../assets/plugins/evocalendar/js/evo-calendar.js"></script>
<script>
$(document).ready(function() {

var events = [ {
    id: "1",
    name: "Prueba1",
    description: "Lorem ipsum dolor sit amet.",
    date: ["04-29-2022","05-02-2022"],
    type: "event"
}];	
		
	
	
	$('#calendar').evoCalendar({
        format: "MM dd, yyyy",
        titleFormat: "MM",
		calendarEvents: events
	});	


//$('#calendar').evoCalendar("addCalendarEvent", events);	

})	
	

	
</script>	
</body>

</html>
