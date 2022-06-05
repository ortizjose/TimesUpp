<?php 
include '..\controller\sessionBean.php';
include '..\model\grupoDB.php';	
$s = new SessionBean();
$gr = new GrupoDB();

	$idUsu = $s -> getIdActualUsuario();

    if(empty($gr->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

// NUEVO GRUPO
    if ( !empty($_POST['integrantesNuevoGrupo']) ){ 		
			
		array_push($_POST['integrantesNuevoGrupo'], $idUsu); // Añadimos el UsuarioActual a los integrantes
		$res = $gr ->anadirGrupo($_POST['nuevoGrupo'], $_POST['integrantesNuevoGrupo']);

	    if($res):
			header('Location: ..\views\admGrupos.php?res=1');
	    else:
			header('Location: ..\views\error.php');
	    endif;
		
	}

// MODIFICAR GRUPO
	elseif( !empty($_POST['modificarGrupo']) ){
		
		$id = $_POST['idGrupo'];
		print_r($id);
		echo "xx $_POST[modificarGrupo] xx";
		array_push($_POST['integrantesModificarGrupo'], $idUsu);
		
		print_r($_POST['integrantesModificarGrupo']);
		
		$res = $gr ->modificarGrupo($_POST['idGrupo'], $_POST['modificarGrupo'], $_POST['integrantesModificarGrupo']);		

	    if($res):
			header('Location: ..\views\admGrupos.php?res=2');
	    else:
			header('Location: ..\views\error.php');
	    endif;
	
	}

// SALIR GRUPO
	elseif ( !empty($_POST['salirGrupo']) ){ 
	

		$res =  $gr ->salirGrupo($_POST['salirGrupo'], $idUsu);
		
	    if($res):
			
			    header('Location: ..\views\admGrupos.php?res=3');
	    else:
			    header('Location: ..\views\error.php');
	    endif;		
		
	}

// BORRAR GRUPO
	elseif ( !empty($_POST['borraGrupo']) ){ 
	

		$res =  $gr ->borrarGrupo($_POST['borraGrupo']);
		
	    if($res):
			
			    header('Location: ..\views\admGrupos.php?res=4');
	    else:
			    header('Location: ..\views\error.php');
	    endif;		
		
	}
	else{
		
		header('Location: ..\views\error.php');

	}

 ?>