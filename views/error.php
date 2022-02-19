<?php
include '..\controller\sessionBean.php';
$s = new SessionBean();
  
  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}


require '..\views\templates\header.html';

?>


<div class="error-404">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Row start -->
        <div class="row">
            <div class="text-uppercase col-xs-12">
                <h1>Error</h1>
                <h5>oops! Algo ha salido Mal</h5>
                <p>oops! Algo ha salido Mal</p>
                <a href="../views/index.php" class="btn btn-error btn-lg waves-effect">Volver al inicio</a>
            </div>
        </div>
        <!-- Row end -->
    </div>
    <!-- Container-fluid ends -->
</div>



<?php require '..\views\templates\footer.html'; ?>
