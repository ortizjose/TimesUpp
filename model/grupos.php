<?php

class Grupos {
	
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

	public function getNombreGrupo($idGrupo)
	{

		$sentence = $this -> dbc->prepare("SELECT Nombre FROM GRUPO WHERE IdGrupo = $idGrupo;");
		$sentence->execute();
		$grupo=$sentence->fetch();	

		return $grupo[0];

	}			
		
	
	

	public function anadirGrupo($nombre, $idUsu, $idGrupo)
	{
		$return = 0;
		
		if (empty($idGrupo) ):
		
			$sentence = $this -> dbc->prepare("SELECT * FROM GRUPO GROUP BY IdGrupo ORDER BY IdGrupo DESC LIMIT 0,1");

			$sentence->execute();
			$grupo=$sentence->fetch();

			$idGrupo = $grupo['IdGrupo'] + 1;
			$return = 1;
		
		endif;
		
			$sentence = $this -> dbc->prepare("INSERT INTO GRUPO(Id, IdGrupo, Nombre, IdUsu) VALUES (NULL,'$idGrupo','$nombre','$idUsu')");

			if ($sentence->execute()):
		
				// En el caso de ser la primera vez que se llama a esta funcion de añadir Grupo, nos devolverá el $idGrupo para que no tenga que volver a hacer dos consultas a BBDD.
				if ($return == 1):
					return $idGrupo;
				endif;
		
				return true;
			else:
				return false;	
			endif;
		

	}
	
	public function getGruposUsuario($idUsu)
	{

		$grupos = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT * FROM GRUPO WHERE IdUsu = $idUsu ");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
				
				$grupos[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $grupos;
	}
		

	public function getIntegrantesGrupo($idGrupo)
	{

		$integrantes = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT Nombre, IdUsu FROM USUARIO WHERE IdUsu IN (SELECT IdUsu FROM GRUPO WHERE IdGrupo = '$idGrupo') ");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
				
				$integrantes[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $integrantes;
	}
		
	
	public function borrarGrupo($idGrupo)
	{

		$sentence = $this -> dbc->prepare("DELETE FROM GRUPO WHERE IdGrupo = $idGrupo;");

		if ($sentence->execute()) 
		{
			return true;
		}
		else
		{
			return false;
		}

	}			
	

}
?>

