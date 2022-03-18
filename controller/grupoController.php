<?php 
include '..\controller\sessionBean.php';
include '..\model\grupoDB.php';	
$s = new SessionBean();
$gr = new GrupoDB();

	$idUsu = $s -> getIdActualUsuario();
	$idGrupo = $_GET['grupo'];
	echo $idGrupo;

    if(empty($gr->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

// CAMBIAR EL EMAIL
    if ( !empty($_POST['nuevoEmail']) ){ 		
				
		//-1 No existe email o no corresponde email no corresponde; 1 OK; 0 Fallo update
		/*$res = $u -> actualizarEmail($idUsu, $_POST['antiguoEmail'], $_POST['nuevoEmail']);
		
		if($res == 0):
			header('Location: ..\views\error.php');
		else:
			header('Location: ..\views\perfil.php?email='.urlencode($res));
		endif;*/
				
	}

// CAMBIAR FOTO PERFIL
    elseif ( !empty($_FILES['fotoGrupo']) ){ 
		
		$foto = $_FILES['fotoGrupo'];
		//print_r($foto);	
		
		$fotoName = $_FILES['fotoGrupo']['name'];
		$fotoTmpName = $_FILES['fotoGrupo']['tmp_name'];
		$fotoSize = $_FILES['fotoGrupo']['size'];
		/* Otras variables
		$fotoError = $_FILES['fotoGrupo']['error'];
		$fotoType = $_FILES['fotoGrupo']['type'];*/
		
		
		$fotoExt = explode('.', $fotoName );
		$fotoActualExt = strtolower(end($fotoExt));
		$allowed = array('jpg', 'jpeg', 'png');
		
		if (!in_array($fotoActualExt, $allowed)):
			header('Location: ..\views\grupo.php?grupo='.urlencode($idGrupo).'&foto=-1');
		elseif( $fotoSize > 5000000 ): // Maximo permitido son 8 mb
			header('Location: ..\views\grupo.php?grupo='.urlencode($idGrupo).'&foto=-2');
		else: 
			//Se mueve al directorio de Avatares
			$NuevoFotoNombre = uniqid('', true).".".$idGrupo.".".$fotoActualExt;
			$DestinoFoto = '../assets/groups/'.$NuevoFotoNombre;
			move_uploaded_file($fotoTmpName, $DestinoFoto);
			
			//Se cambia la foto en la DB
			$res = $gr -> actualizarFotoGrupo($idGrupo, $DestinoFoto);

			if($res):
				header('Location: ..\views\grupo.php?grupo='.urlencode($idGrupo));
			else:
				header('Location: ..\views\error.php');
			endif;
		endif;

}
// ERROR
	else{
		
		header('Location: ..\views\error.php');
		
	}

 ?>