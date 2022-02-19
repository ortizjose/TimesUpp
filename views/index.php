<?php
include '..\controller\sessionBean.php';
include '..\model\genericDB.php';
$s = new SessionBean();
$g = new GenericDB();
  
  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}


require '..\views\templates\header.html';
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

<?php require '..\views\templates\footer.html'; ?>
