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
		
		echo "$_POST[idGrupo]";
		echo "xx $_POST[modificarGrupo] xx";
		
		$gr ->borrarGrupo($_POST['idGrupo']);
	
		// PRIMERO ES EL ADMIN DEL GRUPO
		$gr ->anadirGrupo($_POST['modificarGrupo'], $idUsu, $_POST['idGrupo']);	
		
		foreach($_POST['integrantesModificarGrupo'] as $integrante ):
			$res = $gr ->anadirGrupo($_POST['modificarGrupo'], $integrante, $_POST['idGrupo']);
			//echo $integrante;
		endforeach;		
		
	    if($res){ 
			
			    header('Location: ..\views\admGrupos.php?res=2');
	    }
	    else{
			    echo "HOLA2" ;
	    }	
	
	}

// SALIR GRUPO
	elseif ( !empty($_POST['salirGrupo']) ){ 
	
		//echo "$_POST[borraGrupo]";

		$res =  $gr ->salirGrupo($_POST['salirGrupo'], $idUsu);
		
	    if($res):
			
			    header('Location: ..\views\admGrupos.php?res=3');
	    else:
			    echo "HOLA3" ;
	    endif;		
		
	}

// BORRAR GRUPO
	elseif ( !empty($_POST['borraGrupo']) ){ 
	
		//echo "$_POST[borraGrupo]";

		$res =  $gr ->borrarGrupo($_POST['borraGrupo']);
		
	    if($res){ 
			
			    header('Location: ..\views\admGrupos.php?res=4');
	    }
	    else{
			    echo "HOLA3" ;
	    }			
		
	}
	else{
		echo "HOLA4" ;

		//header('Location: ../index.php?nadaquehacer');
	}

 ?>