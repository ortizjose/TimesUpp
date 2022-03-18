<?php

class GenericDB {
	
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
	
	/* #########################################################################
	   ############################### USUARIO #################################
	   ######################################################################### */

	
	public function getUsuario($idUsu)
	{
		$usuario = array();
		$sentence = $this -> dbc->prepare("SELECT * FROM USUARIO WHERE IdUsu='$idUsu'");
		$sentence->execute();
		$usuario[0]=$sentence->fetch();	

		return $usuario;
	}
	
	
	/* #########################################################################
	   ############################# ACTIVIDADES ###############################
	   ######################################################################### */
		
	
	public function getActividadesUsuario($idUsu)
	{
		$actividades = array();
		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT actividad.IdAct, actividad.Nombre FROM ACTIVIDAD LEFT JOIN grupo ON actividad.IdGrupo = grupo.IdGrupo LEFT JOIN usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo WHERE actividad.IdUsu = '$idUsu' OR usuariogrupo.IdUsu = '$idUsu'");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
		
				$actividades[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $actividades;
	}	
	

	/* #########################################################################
	   ################################ GRUPOS #################################
	   ######################################################################### */	
	
	
	public function getGruposUsuario($idUsu)
	{

		$grupos = array();
		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT grupo.Nombre, grupo.IdGrupo FROM GRUPO INNER JOIN usuariogrupo ON usuariogrupo.IdGrupo=grupo.IdGrupo WHERE usuariogrupo.IdUsu = '$idUsu'");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
		
				$grupos[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $grupos;
	}	
	
	
	
}
?>