<?php
include '..\..\..\..\..\model\tareaDB.php';

$t = new TareaDB();
$tareas = $t -> getTarea($_GET['idAct']);
//print_r($tareas);
$res = array( 
	
		array( "id" => 1,
			   "items" =>[ ]
			 ),
		array( "id" => 2,
			   "items" =>[ ]
			 ),
		array( "id" => 3,
			   "items" =>[ ]
			 )	
		);


foreach( $tareas as $tarea):

	switch ($tarea['Columna']):
		case 1:

			array_push($res[0]['items'], array( "id" => $tarea['IdTarea'] ,"content" => $tarea['Nombre'], "priority" => $tarea['Prioridad']));
			break;
		case 2:

			array_push($res[1]['items'], array( "id" => $tarea['IdTarea'] ,"content" => $tarea['Nombre'], "priority" => $tarea['Prioridad']));
			break;
			
		case 3:
			
			array_push($res[2]['items'], array( "id" => $tarea['IdTarea'] ,"content" => $tarea['Nombre'], "priority" => $tarea['Prioridad']));
			break;
	endswitch;
	

endforeach;

$res = json_encode($res);
print_r($res);


?>