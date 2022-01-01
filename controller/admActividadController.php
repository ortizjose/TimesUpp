<?php 
include '..\model\bdConnection.php';
include '..\controller\sessionBean.php';
	
	$q = new LibraryQueries();
	$s = new SessionBean();

	$idUsu = $s -> getIdActualUsuario();

    if(empty($q->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['nuevaActividad']) ){ 		// NUEVA ACTIVIDAD

	    $res = $q ->anadirActividad($_POST['nuevaActividad'], $idUsu, $_POST['grupoNuevaActividad']);

	    if($res){ 
				header('Location: ..\views\admActividad.php?res=1');
	    }
	    else{
			    header('Location: ..\views\index.php?ERROR1');
	    }
	}
	elseif( !empty($_POST['modificarActividad']) ){ // MODIFICAR ACTIVIDAD 	
		
		$res =  $q ->modificarActividad($_POST['modificarActividad'], $_POST['idActividad'], $_POST['grupoModificarActividad']);
		
	    if($res){ 
			echo "$_POST[grupoModificarActividad]";
			
			    header('Location: ..\views\admActividad.php?res=2');
	    }
	    else{
			    header('Location: ..\views\index.php?ERROR2');
	    }	
	
	}
	elseif ( !empty($_POST['borraActividad']) ){ 
	
		echo "$_POST[borraActividad]";

		$res =  $q ->borrarActividad($_POST['borraActividad']);
		
	    if($res){ 
			
			    header('Location: ..\views\admActividad.php?res=3');
	    }
	    else{
			    header('Location: ..\views\index.php?ERROR3');
	    }			
		
	}
	else{
		header('Location: ../index.php?nadaquehacer');
	}

 ?>