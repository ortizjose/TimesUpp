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
		

		


	
		
	

}
?>

