<?php
include '..\controller\sessionBean.php';
include '..\model\bdConnection.php';
$s = new SessionBean();
$q = new LibraryQueries();

  $Id = $s -> getIdActualUsuario();


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
                        <span>Bienvenido, <b> <?= $s->getActualUsuario() ?> </b> <i class=" icofont icofont-simple-down"></i></span>


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
                        <li><a class="waves-effect waves-dark" href="sample-page.html"><i class="icon-arrow-right"></i><?= $actividad['Nombre'] ?> </a></li>
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
                        <li><a class="waves-effect waves-dark" href="sample-page.html"><i class="icon-arrow-right"></i> <?= $grupo['Nombre'] ?> </a></li>               
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
											
											<?php foreach (($q -> getGruposUsuario($Id)) as $grupo): ?>
											
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





                            <div id="card3" style="min-height: 65px; margin: 0 auto"></div>
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
							 
						<?php $i = 0; foreach (($q -> getActividadesUsuario($Id)) as $actividad): ?>
                            
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
												<input class="form-control" type="text" name="modificarActividad" placeholder="<?= $actividad['Nombre'] ?>" required="required">
											 </div>
											  
										  </div>
											  
										  <div class="form-group row">
											 <label for="example-text-input" class="col-xs-3 col-form-label form-control-label">Nuevo Grupo</label>
											 <div class="col-sm-6">
												<select class="form-control " name="grupoModificarActividad" id="Grupo">
													<option value="Ninguno" >Ninguno</option>

													<?php foreach (($q -> getGruposUsuario($Id)) as $grupo): 
															if (($q -> getIdGrupoActividad($actividad['IdAct'])) != $grupo['IdGrupo']): ?>

																<option value="<?= $grupo['IdGrupo'] ?>" > <?= $grupo['Nombre'] ?> </option>
															
													  <?php else: ?>
													
																<option value="$grupo[IdGrupo]" selected> <?= $grupo['Nombre'] ?> </option>
														
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
											 <label for="example-text-input" class="col-xs-4 col-form-label form-control-label">¿Eliminar la actividad " <?= $actividad['Nombre'] ?> " ?</label>
											  
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
   <script src="../assets/pages/notification.js"></script>
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
