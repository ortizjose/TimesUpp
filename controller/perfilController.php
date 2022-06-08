<?php 
include '..\controller\sessionBean.php';
include '..\model\usuarioDB.php';	
$s = new SessionBean();
$u = new UsuarioDB();

	$idUsu = $s -> getIdActualUsuario();


    if(empty($u->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

// CAMBIAR EL EMAIL
    if ( !empty($_POST['nuevoEmail']) ){ 		
				
		//-1 No existe email o no corresponde email no corresponde; 1 OK; 0 Fallo update
		$res = $u -> actualizarEmail($idUsu, $_POST['antiguoEmail'], $_POST['nuevoEmail']);
		
		if($res == 0):
			header('Location: ..\views\error.php');
		else:
			header('Location: ..\views\perfil.php?email='.urlencode($res));
		endif;
				
	}

// CAMBIAR LA CONTRASEÑA
    elseif ( !empty($_POST['nuevaContrasena']) ){ 		
		
		if($_POST['nuevaContrasena'] == $_POST['nuevaContrasena2']):
		
			//-1 La contraseña no es correcta; 1 OK; 0 Fallo update
			$res = $u -> actualizarContrasena($idUsu, $_POST['antiguaContrasena'], $_POST['nuevaContrasena2']);
			
			if ($res == 0):
				header('Location: ..\views\error.php');
			else:
				header('Location: ..\views\perfil.php?contrasena='.urlencode($res));
			endif;
		
		else:
			header('Location: ..\views\perfil.php?contrasena=-2');
		endif;
				
	}

// CAMBIAR FOTO PERFIL
    elseif ( !empty($_FILES['fotoPerfil']) ){ 
		
		$foto = $_FILES['fotoPerfil'];
		print_r($foto);	
		
		$fotoName = $_FILES['fotoPerfil']['name'];
		$fotoTmpName = $_FILES['fotoPerfil']['tmp_name'];
		$fotoSize = $_FILES['fotoPerfil']['size'];
		/* Otras variables
		$fotoError = $_FILES['fotoPerfil']['error'];
		$fotoType = $_FILES['fotoPerfil']['type'];*/
		
		
		$fotoExt = explode('.', $fotoName );
		$fotoActualExt = strtolower(end($fotoExt));
		$allowed = array('jpg', 'jpeg', 'png');
		
		if (!in_array($fotoActualExt, $allowed)):
			header('Location: ..\views\perfil.php?foto=-1');
		elseif( $fotoSize > 5000000 ): // Maximo permitido son 8 mb
			header('Location: ..\views\perfil.php?foto=-2');
		else: 
			//Se mueve al directorio de Avatares
			$NuevoFotoNombre = uniqid('', true).".".$idUsu.".".$fotoActualExt;
			$DestinoFoto = '../assets/avatar/'.$NuevoFotoNombre;
			move_uploaded_file($fotoTmpName, $DestinoFoto);
			
			//Se cambia la foto en la Sesion
			$s -> setFotoActualUsuario($DestinoFoto);

			//Se cambia la foto en la DB
			$res = $u -> actualizarFoto($idUsu, $DestinoFoto);

			if($res):
				header('Location: ..\views\perfil.php');
			else:
				header('Location: ..\views\error.php');
			endif;
		endif;

}

// CERRAR SESIÓN
    elseif ( !empty($_POST['cerrarSesion']) || !empty($_GET['cerrarSesion']) ){ 

		$s -> closeSession();
		header('Location: ..\views\login.php');		
				
}

// ELIMINAR PERFIL
    elseif ( !empty($_POST['eliminarPerfil']) ){ 

		echo "BORRAR";
		
		$res = $u -> eliminarUsuario($idUsu);
		
		
		if($res):
			$s -> closeSession();
			header('Location: ..\views\login.php');
		else:
			header('Location: ..\views\error.php');
		endif;		
		//$s -> closeSession();
		//header('Location: ..\views\login.php');		
				
}

// ERROR
	else{

		header('Location: ..\views\error.php');
		
	}

 ?>