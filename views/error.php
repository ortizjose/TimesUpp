<?php
include '..\controller\sessionBean.php';
$s = new SessionBean();
  
  $IdUsu = $s -> getIdActualUsuario();

    if ( !isset($_SESSION['Usuario'])){
    	header('Location: ..\views\login.php');  
	}


?>
<!DOCTYPE html>
<html lang="es">

<head>
   <title> Error - TimesUpp </title>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

	<?php require 'templates/GeneralCss.html';?>
	
</head>

<body class="sidebar-mini fixed">



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


</body>

</html>
