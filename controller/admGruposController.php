<?php 
include '..\model\bdConnection.php';
include '..\controller\sessionBean.php';
include '..\model\grupos.php';	
	$q = new LibraryQueries();
	$s = new SessionBean();
	$g = new Grupos();

	$idUsu = $s -> getIdActualUsuario();

    if(empty($q->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['integrantesNuevoGrupo']) ){ 		// NUEVA ACTIVIDAD
			
		// PRIMERO ES EL ADMIN DEL GRUPO
		$idGrupo = $g ->anadirGrupo($_POST['nuevoGrupo'], $idUsu, NULL);
		
		foreach($_POST['integrantesNuevoGrupo'] as $integrante ):
			$res = $g ->anadirGrupo($_POST['nuevoGrupo'], $integrante, $idGrupo);
		endforeach;
	
	    if($res){ 
				header('Location: ..\views\admGrupos.php?res=1');
	    }
	    else{
			  echo "HOLA1" ;
			//header('Location: ..\views\index.php?ERROR1');
	    }
	}
	elseif( !empty($_POST['modificarGrupo']) ){ // MODIFICAR ACTIVIDAD 	
		
		echo "$_POST[idGrupo]";
		echo "xx $_POST[modificarGrupo] xx";
		
		$g ->borrarGrupo($_POST['idGrupo']);
	
		// PRIMERO ES EL ADMIN DEL GRUPO
		$g ->anadirGrupo($_POST['modificarGrupo'], $idUsu, $_POST[idGrupo]);	
		
		foreach($_POST['integrantesModificarGrupo'] as $integrante ):
			$res = $g ->anadirGrupo($_POST['modificarGrupo'], $integrante, $_POST[idGrupo]);
			//echo $integrante;
		endforeach;		
		
	    if($res){ 
			
			    header('Location: ..\views\admGrupos.php?res=2');
	    }
	    else{
			    echo "HOLA2" ;
	    }	
	
	}
	elseif ( !empty($_POST['borraGrupo']) ){ 
	
		//echo "$_POST[borraGrupo]";

		$res =  $g ->borrarGrupo($_POST['borraGrupo']);
		
	    if($res){ 
			
			    header('Location: ..\views\admGrupos.php?res=3');
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