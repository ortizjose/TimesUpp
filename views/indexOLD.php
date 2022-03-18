<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
$s = new SessionBean();
$g = new GenericDB();
  
  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}

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
   <link rel="stylesheet" href="../assets/css/evo-calendar/evo-calendar.css" />
   <link rel="stylesheet" href="../assets/css/evo-calendar/evo-calendar.midnight-blue.css" />
   <script type="text/javascript" src="../assets/js/evo-calendar.js"></script>
	
</head>
	
<body class="sidebar-mini fixed">
   <div class="loader-bg">
      <div class="loader-bar">
      </div>
   </div>
	
	<?php require '..\views\templates\navbarOK.html'; ?>

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

                    <div class="CardB1">
                     <div class="card-block">

					<div id="calendar" ></div>
        <script>
        // initialize your calendar, once the page's DOM is ready
        $(document).ready(function() {
            $('#calendar').evoCalendar({
				theme: 'Midnight Blue',
				language: 'es'
            })
        })
        </script>						 

                     </div>
                  </div>
                </div>
              </div>


               <div class="col-xl-3 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Calendario</h5>
                     </div>

                       

                     <div class="card-block">
                        <div id="card2" style="min-height: 250px; margin: 0 auto"></div>



                     </div>
                  </div>
               </div>

               <div class="col-xl-3 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Actividades</h5>
                     </div>

                      <div class="addScrollActividades">

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
	
	
</body>

</html>
