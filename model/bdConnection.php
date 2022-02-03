<?php

class LibraryQueries {
	
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


	public function comprobarLogin($usuario, $contrasena)
	{

		$peticion="SELECT Nombre FROM USUARIO WHERE Usuario='$usuario'";

		$sentence= $this-> dbc->prepare($peticion);
		if ($sentence->execute())
		{
			$user1=$sentence->fetch();

		} 
		else
		{
			return false;
		}

   	 	if(empty($user1[0]))
   	 	{
   	 		return false;
   	 	}

   	 	$contrasena=md5($contrasena);

   	 	$peticion="SELECT Contrasena FROM USUARIO WHERE Usuario='$usuario'";
		$sentence= $this-> dbc->prepare($peticion);

		if ($sentence->execute())
		{
			$pass=$sentence->fetch();

		} 
		else
		{
			return false;
		}

   	 	if(strnatcasecmp ( $pass[0] , $contrasena) == 0)
   	 	{	
   	 		return true;
   	 	}

   	 	return false;

	}

	public function getIdUsuario($usuario)
	{

		$sentence = $this -> dbc->prepare("SELECT IdUsu FROM USUARIO WHERE Usuario='$usuario'");
		$sentence->execute();
		$id=$sentence->fetch();	

		return $id[0];
	}

	public function getNombreUsuario($usuario)
	{

		$sentence = $this -> dbc->prepare("SELECT Nombre FROM USUARIO WHERE Usuario='$usuario'");
		$sentence->execute();
		$id=$sentence->fetch();	

		return $id[0];
	}	
	

	public function getIdActividadesUsuario($id)
	{

		$actividades = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT IdAct FROM ACTIVIDAD WHERE IdUsu = $id ");

		if ($sentence->execute()) 
		{
			while ($row = $sentence->fetch()) 
			{
				$actividades[$i] = $row;

				$i++;
			}
		
		}

		return $actividades;
	}



	public function getActividadesUsuario($id)
	{

		$actividades = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT * FROM ACTIVIDAD WHERE IdUsu = $id ");

		if ($sentence->execute()) 
		{
			while ($row = $sentence->fetch()) 
			{
				$actividades[$i] = $row;

				$i++;
			}
		
		}

		return $actividades;
	}



	public function getGruposUsuario($id)
	{

		$grupos = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT * FROM GRUPO WHERE IdUsu = $id ORDER BY idGrupo");

		if ($sentence->execute()) 
		{
			while ($row = $sentence->fetch()) 
			{
				$grupos[$i] = $row;

				$i++;
			}
		
		}

		return $grupos;
	}




	public function getTareasUsuario($id)
	{

  		$q = new LibraryQueries();
		$actividades = $q-> getIdActividadesUsuario($id);

		$tareas = array();

		$i = 0;

        foreach ($actividades as $actividad){

			$sentence = $this -> dbc->prepare("SELECT * FROM TAREA WHERE IdAct = $actividad[IdAct]");

			if ($sentence->execute()) 
			{
				while ($row = $sentence->fetch()) 
				{
						$tareas[$i] = $row;						

					$i++;
				}
			}

		}

		return $tareas;
	}


	public function anadirActividad($nombre, $idUsu, $idGrupo)
	{
		if( !is_numeric($idGrupo) ){
			$peticion="INSERT INTO ACTIVIDAD (IdAct, Nombre, IdUsu, IdGrupo) VALUES( NULL, '$nombre', '$idUsu', NULL)";			
		}
		else{
			$peticion="INSERT INTO ACTIVIDAD (IdAct, Nombre, IdUsu, IdGrupo) VALUES( NULL, '$nombre', '$idUsu', '$idGrupo')";
		}		

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()) 
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	public function getIdGrupoActividad($id)
	{

		$sentence = $this -> dbc->prepare("SELECT IdGrupo FROM ACTIVIDAD WHERE IdAct = $id");

		$sentence->execute();
		$grupo=$sentence->fetch();	

		return $grupo[0];

	}	
	
	
	
	public function modificarActividad($nombre, $idAct, $idGrupo)
	{
		if( !is_numeric($idGrupo) ){
			$peticion="UPDATE ACTIVIDAD SET Nombre='$nombre', IdGrupo=NULL WHERE IdAct = $idAct;";			
		}
		else{
			$peticion="UPDATE ACTIVIDAD SET Nombre='$nombre', IdGrupo='$idGrupo' WHERE IdAct = $idAct;";
			//UPDATE `actividad` SET Nombre='PruebaUpdate', IdGrupo='1' WHERE IdAct = 51;
		}		

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()) 
		{
			return true;
		}
		else
		{
			return false;
		}

	}	
	
	
	public function borrarActividad($idAct)
	{

		$sentence = $this -> dbc->prepare("DELETE FROM ACTIVIDAD WHERE IdAct = $idAct;");

		if ($sentence->execute()) 
		{
			return true;
		}
		else
		{
			return false;
		}

	}	

	public function getNombreContactos($idUsu)
	{

		$contactos = array();

		$i = 0;

		$sentence = $this -> dbc->prepare(" SELECT Nombre, IdUsu FROM USUARIO WHERE IdUsu = ( SELECT IdUsu1 FROM CONTACTOS WHERE IdUsu2 = $idUsu) 
		OR IdUsu = (SELECT IdUsu2 FROM CONTACTOS WHERE IdUsu1 = $idUsu) ");

		if ($sentence->execute()): 
			while ($row = $sentence->fetch()):
		
				$contactos[$i] = $row;
				$i++;
		
			endwhile;
		endif;
		
		return $contactos;
	}	
	
	public function getUsuario($idUsu){
		
		$sentence = $this -> dbc->prepare("SELECT Nombre FROM USUARIO WHERE IdUsu = $idUsu;");

		if ($sentence->execute()):
			return true;
		else:
			return false;	
		endif;
		
	}


	public function getIntegrantesGrupo($idGrupo, $idUsu)
	{

		$integrantes = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT Nombre, IdUsu FROM USUARIO WHERE IdUsu IN (SELECT IdUsu FROM GRUPO WHERE IdGrupo = '$idGrupo') AND IdUsu != '$idUsu' ");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
				
				$integrantes[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $integrantes;
	}	
	
	

}
?>

