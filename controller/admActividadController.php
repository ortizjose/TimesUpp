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

// NUEVA ACTIVIDAD
    if ( !empty($_POST['nuevaActividad']) ){ 		

	    $res = $a ->anadirActividad($_POST['nuevaActividad'], $idUsu, $_POST['grupoNuevaActividad']);

	    if($res): 
				header('Location: ..\views\admActividad.php?res=1');
	    else:
			    header('Location: ..\views\error.php');
	    endif;
	}

// MODIFICAR ACTIVIDAD 
	elseif( !empty($_POST['modificarActividad']) ){ 	
		
		$res =  $a ->modificarActividad($_POST['modificarActividad'], $_POST['idActividad'], $_POST['grupoModificarActividad'], $idUsu);
		
	    if($res):			
			    header('Location: ..\views\admActividad.php?res=2');
	    else:
			    header('Location: ..\views\error.php');
		endif;
	}

// BORRAR ACTIVIDAD
	elseif ( !empty($_POST['borraActividad']) ){ 

		$res =  $a ->borrarActividad($_POST['borraActividad']);
		
	    if($res): 
			    header('Location: ..\views\admActividad.php?res=3');
	    else:
			    header('Location: ..\views\error.php');
		endif;
	}

// ERROR
	else{
		header('Location: ..\views\error.php');
	}

 ?>