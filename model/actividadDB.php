<?php

class ActividadDB {
	
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

	
	
	public function getActividadesUsuario($idUsu)
	{
		$actividades = array();
		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT * FROM ACTIVIDAD WHERE IdUsu = $idUsu ");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
		
				$actividades[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $actividades;
	}
	

	
	public function getIdGrupoActividad($idAct)
	{

		$sentence = $this -> dbc->prepare("SELECT IdGrupo FROM ACTIVIDAD WHERE IdAct = $idAct");

		$sentence->execute();
		$grupo=$sentence->fetch();	

		return $grupo[0];

	}		

	

	public function anadirActividad($nombre, $idUsu, $idGrupo)
	{
		if( !is_numeric($idGrupo) ):
			$peticion="INSERT INTO ACTIVIDAD (IdAct, Nombre, IdUsu, IdGrupo) VALUES( NULL, '$nombre', '$idUsu', NULL)";		
		else:
			$peticion="INSERT INTO ACTIVIDAD (IdAct, Nombre, IdUsu, IdGrupo) VALUES( NULL, '$nombre', '$idUsu', '$idGrupo')";
		endif;

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}



	public function modificarActividad($nombre, $idAct, $idGrupo)
	{
		if( !is_numeric($idGrupo) ):
			$peticion="UPDATE ACTIVIDAD SET Nombre='$nombre', IdGrupo=NULL WHERE IdAct = $idAct;";			
		else:
			$peticion="UPDATE ACTIVIDAD SET Nombre='$nombre', IdGrupo='$idGrupo' WHERE IdAct = $idAct;";
		endif;	

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}	
	
	
	
	public function borrarActividad($idAct)
	{
		$sentence = $this -> dbc->prepare("DELETE FROM ACTIVIDAD WHERE IdAct = $idAct;");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}
	
	
	
}
?>

