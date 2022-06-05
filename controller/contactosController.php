<?php 
include '..\controller\sessionBean.php';
include '..\model\usuarioDB.php';	

	$s = new SessionBean();
	$u = new UsuarioDB();

	$idUsu = $s -> getIdActualUsuario();

    if(empty($u ->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

// AÑADIR NUEVO CONTACTO
    if ( !empty($_POST['nuevoContacto']) ){ 		

		$idContacto = $u -> getIdUsuario($_POST['nuevoContacto']);
		
		if (strnatcasecmp($_POST['nuevoContacto'], $s -> getActualUsuario())==0): //CASEO EN QUE SE HAYA USADO EL PROPIO USUARIO
			header('Location: ..\views\contactos.php?contacto=-1');
		
		elseif(empty($idContacto)): //CASO EN QUE NO EXISTA EL USUSARIO
			header('Location: ..\views\contactos.php?contacto=-1');	
		
		else:
			// -1 Porque está pendiente; -2 Porque ya es contacto; 1 Correcto; 0 Inconrrecto
			$res = $u ->anadirContacto($idContacto,$idUsu);
		
			echo $res;
				
			if($res == 1):
				header('Location: ..\views\contactos.php?contacto=1');
			elseif($res == -1):
				header('Location: ..\views\contactos.php?contacto=-2');
			elseif($res == -2):
				header('Location: ..\views\contactos.php?contacto=-3');		
			else:
				header('Location: ..\views\error.php');
			endif;	
		
		endif;		
	}

// ELIMINAR UN CONTACTO
	elseif ( !empty($_POST['borraContacto']) ){ 
	
		$res = $u ->borrarContacto($_POST['borraContacto'],$idUsu);
		
	    if($res):
			header('Location: ..\views\contactos.php?res=2');
	    else:
			header('Location: ..\views\error.php');
		endif;
		
	}

// ACEPTAR UN CONTACTO
	elseif ( !empty($_POST['idContactoAceptar']) ){
		
		$res = $u ->aceptarContacto($idUsu, $_POST['idContactoAceptar']);
		
	    if($res):
			header('Location: ..\views\contactos.php');
	    else:
			header('Location: ..\views\error.php');
		endif;		
	}

// RECHAZAR UN CONTACTO
	elseif ( !empty($_POST['idContactoRechazar']) ){
		
		$res = $u ->rechazarContacto($idUsu, $_POST['idContactoRechazar']);
		
	    if($res):
			header('Location: ..\views\contactos.php');
	    else:
			header('Location: ..\views\error.php');
		endif;
	
	}

// ERROR
	else{
		
		header('Location: ..\views\error.php');
	}

 ?>