<?php 
include '..\controller\sessionBean.php';
include '..\model\actividadDB.php';	
$s = new SessionBean();
$a = new ActividadDB();

	$idUsu = $s -> getIdActualUsuario();

    if(empty($a->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['nuevaActividad']) ){ 		// NUEVA ACTIVIDAD

	    $res = $a ->anadirActividad($_POST['nuevaActividad'], $idUsu, $_POST['grupoNuevaActividad']);

	    if($res): 
				header('Location: ..\views\admActividad.php?res=1');
	    else:
			    header('Location: ..\views\error.php');
	    endif;
	}
	elseif( !empty($_POST['modificarActividad']) ){ // MODIFICAR ACTIVIDAD 	
		
		$res =  $a ->modificarActividad($_POST['modificarActividad'], $_POST['idActividad'], $_POST['grupoModificarActividad']);
		
	    if($res):			
			    header('Location: ..\views\admActividad.php?res=2');
	    else:
			    header('Location: ..\views\error.php');
		endif;
	}
	elseif ( !empty($_POST['borraActividad']) ){ 

		$res =  $a ->borrarActividad($_POST['borraActividad']);
		
	    if($res): 
			    header('Location: ..\views\admActividad.php?res=3');
	    else:
			    header('Location: ..\views\error.php');
		endif;
	}
	else{
		header('Location: ..\views\error.php');
	}

 ?>