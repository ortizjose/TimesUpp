<?php
include '..\..\..\..\..\model\tareaDB.php';


if ( !is_numeric($_GET['arg1']) ):

	$t = new TareaDB();
	$t -> modificarContTarea($_GET['idTarea'], $_GET['arg1'], $_GET['arg2'] );

	print_r("cont");

else:

	$t = new TareaDB();
	$t -> modificarPosTarea($_GET['idTarea'], $_GET['arg1'], $_GET['arg2'] );

	print_r("pos");
endif;


?>