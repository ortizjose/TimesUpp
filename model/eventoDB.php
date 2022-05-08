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

		/*$sentence = $this -> dbc->prepare(" SELECT eventos.IdEve, eventos.Nombre, eventos.Etiqueta, 
											eventos.Descripcion, eventos.Fecha,	eventos.FechaFin,
											FROM eventos JOIN ACTIVIDAD on eventos.IdAct=actividad.IdAct 
											LEFT JOIN grupo ON actividad.IdGrupo = grupo.IdGrupo LEFT JOIN 
											usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo 
											WHERE actividad.IdUsu = '$idUsu' OR usuariogrupo.IdUsu = '$idUsu'; ");*/
		
		/*$sentence = $this -> dbc->prepare(" SELECT eventos.IdEve, eventos.Nombre, eventos.Etiqueta, 
									eventos.Descripcion, DATE_FORMAT(eventos.Fecha, '%m-%d-%Y') AS Fecha, 
									DATE_FORMAT(eventos.FechaFin, '%m-%d-%Y') AS FechaFin 
									FROM eventos JOIN ACTIVIDAD on eventos.IdAct=actividad.IdAct 
									LEFT JOIN grupo ON actividad.IdGrupo = grupo.IdGrupo LEFT JOIN 
									usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo 
									WHERE actividad.IdUsu = '$idUsu' OR usuariogrupo.IdUsu = '$idUsu'; ");*/
		
		$sentence = $this -> dbc->prepare("SELECT eventos.IdEve, eventos.Nombre, eventos.Etiqueta, eventos.Descripcion, 
											DATE_FORMAT(eventos.Fecha, '%m-%d-%Y') AS Fecha, DATE_FORMAT(eventos.FechaFin, '%m-%d-%Y') AS FechaFin  
											FROM EVENTOS WHERE IdUsu = '$idUsu' OR (Grupal=1 AND IdAct = ANY 
												(SELECT actividad.IdAct FROM ACTIVIDAD LEFT JOIN grupo ON actividad.IdGrupo = grupo.IdGrupo 
												LEFT JOIN usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo WHERE actividad.IdUsu = '$idUsu' 
												OR usuariogrupo.IdUsu = '$idUsu'));");

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

	
	public function borrarEvento($idEve)
	{
		$sentence = $this -> dbc->prepare("DELETE FROM EVENTOS WHERE IdEve = $idEve;");

		if ($sentence->execute()):
			return "HOLA";
		else:
			return false;
		endif;
	}
		

	public function getEventosActividad($idAct)
	{
		$eventos = array();

		$i = 0;
		
		$sentence = $this -> dbc->prepare("SELECT eventos.IdEve, eventos.Nombre, eventos.Etiqueta, eventos.Descripcion, 
											DATE_FORMAT(eventos.Fecha, '%m-%d-%Y') AS Fecha, DATE_FORMAT(eventos.FechaFin, '%m-%d-%Y') AS FechaFin  
											FROM EVENTOS WHERE IdUsu = '$idUsu' OR (Grupal=1 AND IdAct = ANY 
												(SELECT actividad.IdAct FROM ACTIVIDAD LEFT JOIN grupo ON actividad.IdGrupo = grupo.IdGrupo 
												LEFT JOIN usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo WHERE actividad.IdUsu = '$idUsu' 
												OR usuariogrupo.IdUsu = '$idUsu'));");

		if ($sentence->execute()): 
			while ($row = $sentence->fetch()):
		
				$eventos[$i] = $row;
				$i++;
		
			endwhile;
		endif;
		
		return $eventos;		
		
		
	}
	
	
}
?>

