<?php

class UsuarioDB {
	
	public $usuario = 'root';

	public $pass = '';

	public $dbc;


	public function __construct(){
	//Connect to the database
	$this->dbc = $this->dbconnect();

	}

	/* Connect to the database and table library */
	public function dbconnect() 
	{

	$dbc = null;
	
	try {

		$dbc = new PDO('mysql:host=localhost; dbname=timesupp', $this->usuario, $this->pass, array(PDO::ATTR_PERSISTENT => true));
		} catch (PDOException $e) {
			return null;
		}
		return $dbc;
	}

	
	
	public function registrarUsuario($usuario, $nombre, $contrasena, $email)
	{

		$peticion="SELECT Nombre FROM USUARIO WHERE Email='$email'";

		$sentence= $this-> dbc->prepare($peticion);
		$sentence->execute();
		$usuario1=$sentence->fetch();
	
		// Se comprueba si ya existe una cuenta con dicho Email
   	 	if(!empty($usuario1[0]))
   	 	{
   	 		return -1;
			
   	 	}

		$peticion="SELECT Nombre FROM USUARIO WHERE Usuario='$usuario'";

		$sentence= $this-> dbc->prepare($peticion);
		$sentence->execute();
		$usuario1=$sentence->fetch();
	
		// Se comprueba si ya existe un usuario con dicho apodo.
   	 	if(!empty($usuario1[0]))
   	 	{
   	 		return -2;
			
   	 	}		
		
	
		//$output = implode(',', $output); //para hacer debug de la funcion
    	//echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
		
		// Inserción en BBDD del usuario
		$contrasena=md5($contrasena);	
		$peticion="INSERT INTO USUARIO (IdUsu, Usuario, Nombre, Contrasena, Email, Foto) VALUES ( NULL, '$usuario', '$nombre', '$contrasena', '$email', '../assets/avatar/default.png')";			
		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()) 
		{
			return 1;
		}
		else
		{
			return 0;
		}		

	}


	
	public function comprobarLogin($usuario, $contrasena)
	{

		$peticion="SELECT Nombre FROM USUARIO WHERE Usuario='$usuario'";

		$sentence= $this-> dbc->prepare($peticion);
		if ($sentence->execute()):
			$user1=$sentence->fetch();
		else:
			return false;
		endif;
		
   	 	if(empty($user1[0])):
   	 		return -1;
		endif;
		
   	 	$contrasena=md5($contrasena);

   	 	$peticion="SELECT Contrasena FROM USUARIO WHERE Usuario='$usuario'";
		$sentence= $this-> dbc->prepare($peticion);

		if ($sentence->execute()):
			$pass=$sentence->fetch();
		else:	
			return false;
		endif;
		
   	 	if(strnatcmp ( $pass[0] , $contrasena) == 0): // Sensible mayus/minus
   	 		return 1;
		else:
	   	 	return -2;	
   	 	endif;
		
	}
	
	

	public function getIdUsuario($usuario)
	{

		$sentence = $this -> dbc->prepare("SELECT IdUsu FROM USUARIO WHERE Usuario='$usuario'");
		$sentence->execute();
		$id=$sentence->fetch();
		
		if(empty($id[0])):
			return 0;
		else:
			return $id[0];
		endif;
	}		

	
	public function getUsuario($idUsu)
	{
		$usuario = array();
		$sentence = $this -> dbc->prepare("SELECT * FROM USUARIO WHERE IdUsu='$idUsu'");
		$sentence->execute();
		$usuario[0]=$sentence->fetch();	

		return $usuario;
	}		

	
	public function actualizarEmail($idUsu, $antiguoEmail, $nuevoEmail)
	{
		$sentence = $this -> dbc->prepare("SELECT IdUsu FROM USUARIO WHERE Email='$antiguoEmail' AND IdUsu='$idUsu'");
		$sentence->execute();
		$usuario=$sentence->fetch();
		
		if(empty($usuario[0])):
			return -1;
		else:
		
			$sentence = $this -> dbc->prepare("UPDATE USUARIO SET Email='$nuevoEmail' WHERE IdUsu='$idUsu'");

			if ($sentence->execute()):
				return 1;
			else:
				return 0;
			endif;
	
		endif;			
	}

	public function actualizarContrasena($idUsu, $antiguaContrasena, $nuevaContrasena)
	{
		$antiguaContrasena=md5($antiguaContrasena);
		$sentence = $this -> dbc->prepare("SELECT IdUsu FROM USUARIO WHERE Contrasena='$antiguaContrasena' AND IdUsu='$idUsu'");
		$sentence->execute();
		$usuario=$sentence->fetch();
		
		if(empty($usuario[0])):
			return -1;
		else:
		
			$nuevaContrasena=md5($nuevaContrasena);
			$sentence = $this -> dbc->prepare("UPDATE USUARIO SET Contrasena='$nuevaContrasena' WHERE IdUsu='$idUsu'");

			if ($sentence->execute()):
				return 1;
			else:
				return 0;
			endif;
	
		endif;		
	}

	public function actualizarFoto($idUsu, $Destino)
	{

		$sentence = $this -> dbc->prepare("UPDATE USUARIO SET Foto='$Destino' WHERE IdUsu = $idUsu");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	
	}

	public function getNumContactos($idUsu)
	{
		//$num = array();
		$sentence = $this -> dbc->prepare("SELECT count(*) AS contactos FROM CONTACTOS 
											WHERE (IdUsu1=$idUsu OR IdUsu2=$idUsu) AND Pendiente=0");
		$sentence->execute();
		$num=$sentence->fetch();	

		return $num[0];
	}		
	
	public function getNumActividades($idUsu)
	{
		//$num = array();
		$sentence = $this -> dbc->prepare("SELECT count(*) FROM ACTIVIDAD LEFT JOIN grupo ON actividad.IdGrupo = grupo.IdGrupo LEFT JOIN usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo WHERE actividad.IdUsu = $idUsu OR usuariogrupo.IdUsu = $idUsu");
		$sentence->execute();
		$num=$sentence->fetch();	

		return $num[0];
	}	
	
	public function getNumGrupos($idUsu)
	{
		//$num = array();
		$sentence = $this -> dbc->prepare("SELECT count(*) AS grupos FROM GRUPO g 
											JOIN usuariogrupo ug ON ug.IdGrupo = g.IdGrupo 
											WHERE ug.IdUsu=$idUsu");
		$sentence->execute();
		$num=$sentence->fetch();	

		return $num[0];
	}	
	
	
	/* #########################################################################
	   ############################## CONTACTOS ################################
	   ######################################################################### */
	
	
	public function getContactos($idUsu)
	{

		$contactos = array();

		$i = 0;

		$sentence = $this -> dbc->prepare(" SELECT * FROM USUARIO WHERE IdUsu = ANY ( SELECT IdUsu1 FROM CONTACTOS WHERE IdUsu2 = $idUsu AND Pendiente = 0) OR IdUsu = ANY (SELECT IdUsu2 FROM CONTACTOS WHERE IdUsu1 = $idUsu AND Pendiente = 0) ");

		if ($sentence->execute()): 
			while ($row = $sentence->fetch()):
		
				$contactos[$i] = $row;
				$i++;
		
			endwhile;
		endif;
		
		return $contactos;
	}		
	
	
	public function borrarContacto($idContacto, $idUsu)
	{

		$sentence = $this -> dbc->prepare("DELETE FROM CONTACTOS WHERE (IdUsu1 = $idContacto AND IdUsu2 = $idUsu) OR (IdUsu2 = $idContacto AND IdUsu1 = $idUsu)");

		if ($sentence->execute()): 
			return true;
		else:
			return false;
		endif;
		
	}
		
	// Devuelve -1 si exite la petición, -2 si ya son contactos, 1 si se ha añadido y 0 si no se ha añadido
	public function anadirContacto($idUsu1, $idUsu2)
	{
		//Se comprueba si ya existe la petición o contacto
		$sentence = $this -> dbc->prepare("SELECT Pendiente FROM CONTACTOS WHERE (IdUsu1 = $idUsu1 AND IdUsu2 = $idUsu2) OR (IdUsu2 = $idUsu1 AND IdUsu1 = $idUsu2)");
		$sentence->execute();
		$contacto=$sentence->fetch();
		
		if(!is_null($contacto[0])):
			return $contacto[0]-2;
		endif;		
		
		
		//Añade el nuevo contacto
		$sentence = $this -> dbc->prepare("INSERT INTO CONTACTOS (IdContacto, IdUsu1, IdUsu2, Pendiente) VALUES (NULL,'$idUsu1','$idUsu2','1')");

		if ($sentence->execute()): 
			return true;
		else:
			return false;
		endif;

	}	
	
	public function getContactosPendientesEntrantes($idUsu)
	{

		$contactosp = array();
		$i = 0;

		$sentence = $this -> dbc->prepare(" SELECT IdUsu, Nombre, Usuario FROM usuario Where IdUsu = ANY (SELECT IdUsu2 FROM contactos Where IdUsu1 = '$idUsu' And Pendiente = 1) ");

		if ($sentence->execute()): 
			while ($row = $sentence->fetch()):
		
				$contactosp[$i] = $row;
				$i++;
		
			endwhile;
		endif;
		
		return $contactosp;		
		
	}
	
	
	public function getContactosPendientesSalientes($idUsu)
	{

		$contactosp = array();
		$i = 0;

		$sentence = $this -> dbc->prepare(" SELECT IdUsu, Nombre, Usuario FROM usuario Where IdUsu = ANY (SELECT IdUsu1 FROM contactos Where IdUsu2 = '$idUsu' And Pendiente = 1) ");

		if ($sentence->execute()): 
			while ($row = $sentence->fetch()):
		
				$contactosp[$i] = $row;
				$i++;
		
			endwhile;
		endif;
		
		return $contactosp;		
		
	}	
	
	public function aceptarContacto($idUsu1, $idUsu2)
	{

		$sentence = $this -> dbc->prepare("UPDATE CONTACTOS SET Pendiente='0' WHERE IdUsu1 = $idUsu1 AND IdUsu2 = $idUsu2;");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	
	}

	public function rechazarContacto($idUsu1, $idUsu2)
	{

		$sentence = $this -> dbc->prepare("DELETE FROM CONTACTOS WHERE IdUsu1 = $idUsu1 AND IdUsu2 = $idUsu2;");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	
	}	
	
	
	
	
}
?>

