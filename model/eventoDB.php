<?php

class EventoDB {
	
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

	public function getEventos($idUsu)
	{

		$eventos = array();

		$i = 0;

		$sentence = $this -> dbc->prepare(" SELECT * FROM EVENTOS
												WHERE IdUsu = '$idUsu'");

		if ($sentence->execute()): 
			while ($row = $sentence->fetch()):
		
				$eventos[$i] = $row;
				$i++;
		
			endwhile;
		endif;
		
		return $eventos;
	}	

	public function anadirEvento($nombre, $etiqueta, $descrip, $fecha, $fechafin, $idUsu, $idAct, $grupal)
	{
		if (empty($fechafin)):

			$peticion="INSERT INTO EVENTOS (IdEve, Nombre, Etiqueta, Descripcion, Fecha, FechaFin, IdUsu, IdAct, Grupal) 
						VALUES(NULL,'$nombre', '$etiqueta', '$descrip', '$fecha', NULL, '$idUsu', '$idAct', '$grupal')";
		else:
		
			$peticion="INSERT INTO EVENTOS (IdEve, Nombre, Etiqueta, Descripcion, Fecha, FechaFin, IdUsu, IdAct, Grupal) 
						VALUES(NULL,'$nombre', '$etiqueta', '$descrip', '$fecha', '$fechafin', '$idUsu', '$idAct', '$grupal')";	
		endif;

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}	

}
?>

