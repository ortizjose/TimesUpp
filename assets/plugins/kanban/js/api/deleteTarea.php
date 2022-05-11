<?php
include '..\..\..\..\..\model\tareaDB.php';

$t = new TareaDB();
$t -> borrarTarea($_GET['arg2']);

?>