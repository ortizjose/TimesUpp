<?php
include '..\controller\sessionBean.php';
include '..\model\bdConnection.php';
$s = new SessionBean();
$q = new LibraryQueries();
  
  $Id = $s -> getIdActualUsuario();

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
   <!-- Favicon icon -->
   <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
   <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

   <!-- themify -->
   <link rel="stylesheet" type="text/css" href="../assets/icon/themify-icons/themify-icons.css">

   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="../assets/icon/icofont/css/icofont.css">

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="../assets/icon/simple-line-icons/css/simple-line-icons.css">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.min.css">

   <!-- Chartlist chart css -->
   <link rel="stylesheet" href="../assets/plugins/chartist/dist/chartist.css" type="text/css" media="all">

   <!-- Weather css -->
   <link href="../assets/css/svg-weather.css" rel="stylesheet">


   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="../assets/css/main.css">

   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

</head>

<body class="sidebar-mini fixed">
   <div class="loader-bg">
      <div class="loader-bar">
      </div>
   </div>
   <div class="wrapper">
      <!-- Navbar-->
      <header class="main-header-top hidden-print">
         <a href="index.php" class="logo"><img class="img-fluid able-logo" src="../assets/images/logo.png" alt="Theme-logo"></a>
         <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>



               <ul class="top-nav">
                  <!--Notification Menu-->
                    
                  <li class="dropdown notification-menu">
                     <a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                        <i class="icon-bell"></i>
                        <span class="badge badge-danger header-badge">9</span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="not-head">You have <b class="text-primary">4</b> new notifications.</li>
                        <li class="bell-notification">
                           <a href="javascript:;" class="media">
                              <span class="media-left media-icon">
                    <img class="img-circle" src="../assets/images/avatar-1.png" alt="User Image">
                  </span>
                              <div class="media-body"><span class="block">Lisa sent you a mail</span><span class="text-muted block-time">2min ago</span></div>
                           </a>
                        </li>
                        <li class="bell-notification">
                           <a href="javascript:;" class="media">
                              <span class="media-left media-icon">
                    <img class="img-circle" src="../assets/images/avatar-2.png" alt="User Image">
                  </span>
                              <div class="media-body"><span class="block">Server Not Working</span><span class="text-muted block-time">20min ago</span></div>
                           </a>
                        </li>
                        <li class="bell-notification">
                           <a href="javascript:;" class="media"><span class="media-left media-icon">
                    <img class="img-circle" src="../assets/images/avatar-3.png" alt="User Image">
                  </span>
                                    <div class="media-body"><span class="block">Transaction xyz complete</span><span class="text-muted block-time">3 hours ago</span></div></a>
                        </li>
                        <li class="not-footer">
                           <a href="#!">See all notifications.</a>
                        </li>
                     </ul>
                  </li>

                  <!-- window screen -->
                  <li class="pc-rheader-submenu">
                     <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                        <i class="icon-size-fullscreen"></i>
                     </a>

                  </li>
                  <!-- User Menu-->
                  <li class="dropdown">
                     <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                        <span><img class="img-circle " src="../assets/images/avatar-1.png" style="width:40px;" alt="User Image"></span>                        
                        <span>Bienvenido, <b> <?= $s->getActualUsuario(); ?> </b> <i class=" icofont icofont-simple-down"></i></span>


                     </a>
                     <ul class="dropdown-menu settings-menu">
                        <li><a href="#!"><i class="icon-settings"></i> Settings</a></li>
                        <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                        <li><a href="#"><i class="icon-envelope-open"></i> My Messages</a></li>
                        <li class="p-0">
                           <div class="dropdown-divider m-0"></div>
                        </li>
                        <li><a href="#"><i class="icon-lock"></i> Lock Screen</a></li>
                        <li><a href="includes/logout.php"><i class="icon-logout"></i> Cerrar Sesión</a></li>

                     </ul>
                  </li>
               </ul>

            </div>
         </nav>
      </header>
      <!-- Side-Nav-->
      <aside class="main-sidebar hidden-print ">
         <section class="sidebar" id="sidebar-scroll">
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">

                <!-- Barra Navegacion-->            
                <li class="nav-level">--- Navegación</li>

				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/index.php") == 0):?> 
				
                  <li class="active treeview">
					  
				<?php else:?>

                  <li class="treeview">
					  
				<?php endif;?>

                    <a class="waves-effect waves-dark" href="index.php">
                        <i class="icon-speedometer" ></i><span> Dashboard</span>
                    </a>                
                </li>


				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/XXXX.php") == 0):?> 

                  <li class="active treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-docs"></i><span>Actividades</span><i class="icon-arrow-down"></i></a>
                
				<?php else:?>
					  
                  <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-list"></i><span>Actividades</span><i class="icon-arrow-down"></i></a>

				<?php endif;
					  
                foreach (($q -> getActividadesUsuario($Id)) as $actividad): ?>
 
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="sample-page.html"><i class="icon-arrow-right"></i><?= $actividad['Nombre']; ?> </a></li>
                    </ul>
					  
				<?php endforeach; ?>
					  
                  </li>



				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/XXXX.php") == 0):?>
				
                  <li class="active treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-docs"></i><span>Grupos</span><i class="icon-arrow-down"></i></a>
					  
 				<?php else: ?>
					  
                  <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-people"></i><span>Grupos</span><i class="icon-arrow-down"></i></a>
				<?php endif;
					  
                foreach (($q -> getGruposUsuario($Id)) as $grupo): ?>

                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="sample-page.html"><i class="icon-arrow-right"></i> <?= $grupo['Nombre']; ?> </a></li>               
                    </ul>

				<?php endforeach; ?>
					  
                  </li>

                <!-- Barra Acciones-->  
                <li class="nav-level">--- Acciones</li>

				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/XXXX.php") == 0):?>
				
                  <li class="active treeview">
					  
 				<?php else: ?>
					  
                  <li class="treeview">
					 
				<?php endif; ?>
					  
                    <a class="waves-effect waves-white" href="admActividad.php">
                        <i class="icon-pencil" ></i><span> Administrar Actividad </span>
                    </a>                
                </li>


				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/XXXX.php") == 0):?>
				
                  <li class="active treeview">
					  
 				<?php else: ?>
					  
                  <li class="treeview">
					  
				<?php endif; ?>
					  
                    <a class="waves-effect waves-dark" href="loquesea.php">
                        <i class="icon-note" ></i><span> Crear Tarea </span>
                    </a>                
                </li>


				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/XXXX.php") == 0):?>
				
                  <li class="active treeview">
					  
 				<?php else: ?>
					  
                  <li class="treeview">
					  
				<?php endif; ?>
					  
                    <a class="waves-effect waves-dark" href="loquesea.php">
                        <i class="icon-clock" ></i><span> Crear Recordatorio </span>
                    </a>                
                </li>


				<!-- Colorea el elemento o no, si está en la pagina del elemento -->
				<?php if (strnatcasecmp($_SERVER["REQUEST_URI"],"/timesupp/views/XXXX.php") == 0):?>
				
                  <li class="active treeview">
					  
 				<?php else: ?>

                  <li class="treeview">
					  
				<?php endif; ?>

                    <a class="waves-effect waves-dark" href="index.php">
                        <i class="icon-user-follow" ></i><span> Crear Grupo </span>
                    </a>                
                </li>

				
				
				
                </li>
            </ul>
         </section>
      </aside>



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
               <div class="col-xl-7 col-lg-12">
                  <div class="card">


                    <div class="addCardTareas">
                     <div class="card-block">

                        <ul class="nav nav-tabs md-tabs" role="tablist">
                          <li class="nav-item">
                             <a class="card-header-text nav-link active" data-toggle="tab" href="#home3" role="tab">Tareas</a>
                             <div class="slide"></div>
                          </li>
                          <li class="nav-item">
                             <a class="card-header-text nav-link" data-toggle="tab" href="#profile3" role="tab">Recordatorios</a>
                             <div class="slide"></div>
                          </li>

                        </ul>

                      <!-- Tab Content -->
                       <div class="tab-content">

                        <!-- Tab 1 -->
                          <div class="tab-pane active" id="home3" role="tabpanel">

                            <div id="card3" style="min-height: 50px; margin: 0 auto"></div>

                              <div class="col-lg-4 col-md-6">
                                <h6 class="sub-title text-uppercase" align="center">Pendiente</h6>

                                <div class="red-colors colors">
                                   <ul>
<!--
                                     //foreach ($tareas as $tarea):

									   
                                          <li>
                                          <p class="m-b-10" style="text-transform:none;">$tarea[Nombre]</p>
                                          </li>

									//endif; endforeach;
-->									   
                                   </ul>

                                </div>
                              </div>

                              <div class="col-lg-4 col-md-6">
                                <h6 class="sub-title text-uppercase" align="center">Haciendo</h6>

                                <div class="blue-grey-colors colors">

									<ul>
<!--


                                      foreach ($tareas as $tarea){
                                
                                       
                                        {
                                        echo<<<_END
                                          <li>
                                          <p class="text-dark m-b-10" style="text-transform:none;">$tarea[Nombre]</p>
                                          </li>
                                        _END;
                                        }
                                      }

-->
                                   </ul>
                                </div>
                              </div>

                              <div class="col-lg-4 col-md-6">
                                <h6 class="sub-title text-uppercase" align="center">Hecho</h6>

                                <div class="green-colors colors">
                                   <ul>
<!--									   

                                      foreach ($tareas as $tarea){
                                
                                        
                                        {
                                        echo<<<_END
                                          <li>
                                          <p class="m-b-10" style="text-transform:none;">$tarea[Nombre]</p>
                                          </li>
                                        _END;
                                        }
                                      }

-->
                                   </ul>
                                </div>
                              </div>

                          </div>

                          <!-- Tab 2 -->
                          <div class="tab-pane" id="profile3" role="tabpanel">

                            <div id="card3" style="min-height: 50px; margin: 0 auto"></div>


                              <div class="col-lg-4 col-md-6">
                                <h6 class="sub-title text-uppercase">Tarea</h6>
                              </div>

                              <div class="col-lg-4 col-md-6">
                                <h6 class="sub-title text-uppercase">Recordatorio</h6>
                              </div>

                              <div class="col-lg-4 col-md-6">
                                <h6 class="sub-title text-uppercase">Aviso</h6>
                              </div>

                          </div>

                       </div>


                     </div>
                  </div>
                </div>
              </div>


               <div class="col-xl-5 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Calendario</h5>
                     </div>

                       

                     <div class="card-block">
                        <div id="card2" style="min-width: 250px; min-height: 350px; margin: 0 auto"></div>



                     </div>
                  </div>
               </div>

               <div class="col-xl-5 col-lg-12">
                  <div class="card">
                     <div class="card-header">
                        <h5 class="card-header-text">Actividades</h5>
                     </div>

                      <div class="addScrollActividades">

                        <div class="card-block button-list">

						<?php foreach (($q -> getActividadesUsuario($Id)) as $actividad): ?>

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


   <!-- Warning Section Starts -->
   <!-- Older IE warning message -->
   <!--[if lt IE 9]>
      <div class="ie-warning">
          <h1>Warning!!</h1>
          <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
          <div class="iew-container">
              <ul class="iew-download">
                  <li>
                      <a href="http://www.google.com/chrome/">
                          <img src="../assets/images/browser/chrome.png" alt="Chrome">
                          <div>Chrome</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.mozilla.org/en-US/firefox/new/">
                          <img src="../assets/images/browser/firefox.png" alt="Firefox">
                          <div>Firefox</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://www.opera.com">
                          <img src="../assets/images/browser/opera.png" alt="Opera">
                          <div>Opera</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.apple.com/safari/">
                          <img src="../assets/images/browser/safari.png" alt="Safari">
                          <div>Safari</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                          <img src="../assets/images/browser/ie.png" alt="">
                          <div>IE (9 & above)</div>
                      </a>
                  </li>
              </ul>
          </div>
          <p>Sorry for the inconvenience!</p>
      </div>
      <![endif]-->
   <!-- Warning Section Ends -->

   <!-- Required Jqurey -->
   <script src="../assets/plugins/Jquery/dist/jquery.min.js"></script>
   <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
   <script src="../assets/plugins/tether/dist/js/tether.min.js"></script>

   <!-- Required Fremwork -->
   <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

   <!-- Scrollbar JS-->
   <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
   <script src="../assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>

   <!--classic JS-->
   <script src="../assets/plugins/classie/classie.js"></script>

   <!-- notification -->
   <script src="../assets/plugins/notification/js/bootstrap-growl.min.js"></script>

   <!-- Sparkline charts -->
   <script src="../assets/plugins/jquery-sparkline/dist/jquery.sparkline.js"></script>

   <!-- Counter js  -->
   <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
   <script src="../assets/plugins/countdown/js/jquery.counterup.js"></script>

   <!-- Echart js -->
   <script src="../assets/plugins/charts/echarts/js/echarts-all.js"></script>

   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script src="https://code.highcharts.com/modules/exporting.js"></script>
   <script src="https://code.highcharts.com/highcharts-3d.js"></script>

   <!-- custom js -->
   <script type="text/javascript" src="../assets/js/main.min.js"></script>
   <script type="text/javascript" src="../assets/pages/dashboard.js"></script>
   <script type="text/javascript" src="../assets/pages/elements.js"></script>
   <script src="../assets/js/menu.min.js"></script>
<script>
var $window = $(window);
var nav = $('.fixed-button');
$window.scroll(function(){
    if ($window.scrollTop() >= 200) {
       nav.addClass('active');
    }
    else {
       nav.removeClass('active');
    }
});
</script>

</body>

</html>
