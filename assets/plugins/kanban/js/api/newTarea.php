<?php
include '..\..\..\..\..\model\tareaDB.php';

$t = new TareaDB();
$idTarea = $t -> anadirTarea($_GET['idAct'], $_GET['arg2'], $_GET['arg3'] );
print_r($idTarea);


?>