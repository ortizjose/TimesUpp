<?php
include '..\..\..\..\model\eventoDB.php';

$e = new EventoDB();
$e -> borrarEvento($_GET['id']);

?>