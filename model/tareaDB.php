<?php

class TareaDB {
	
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

	
	public function getTarea($idAct)
	{
		$tareas = array();
		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT * FROM TAREA WHERE IdAct=$idAct ORDER BY Columna ASC, Posicion ASC;");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
		
				$tareas[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $tareas;
	}
	
	public function anadirTarea($idAct, $columna, $posicion)
	{
		

		$peticion="INSERT INTO TAREA (Columna, Posicion, IdAct) VALUES($columna, $posicion, $idAct)";

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()):
			
			$sentence = $this -> dbc->prepare("SELECT LAST_INSERT_ID() as IdTarea;");
		
			if ($sentence->execute()):
		
				$idTarea=$sentence->fetch();
				return $idTarea[0];
			else:
		
				return false;
			endif;
		else:
		
			return false;
		endif;
	}	

	
	public function modificarContTarea($idTarea, $nombre, $prioridad)
	{

		$peticion="UPDATE TAREA SET Nombre='$nombre', Prioridad=$prioridad WHERE IdTarea = $idTarea;";

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}		

	
	public function modificarPosTarea($idTarea, $columna, $posicion)
	{
		$peticion="UPDATE TAREA SET Columna=$columna, Posicion=$posicion WHERE IdTarea = $idTarea;";

		$sentence = $this -> dbc->prepare($peticion);

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}
	
	
	public function borrarTarea($idTarea)
	{
		$sentence = $this -> dbc->prepare("DELETE FROM TAREA WHERE IdTarea = $idTarea;");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	}	
	
}
?>

