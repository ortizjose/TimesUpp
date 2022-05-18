<?php

class GrupoDB {
	
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

	public function getGrupo($idGrupo)
	{
		
		$grupo = array();
		$sentence = $this -> dbc->prepare("SELECT * FROM GRUPO WHERE IdGrupo='$idGrupo'");
		$sentence->execute();
		$grupo[0]=$sentence->fetch();	
		
		return $grupo;	
	}

	
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

	
	
	public function getIntegrantesContactos($idGrupo, $idUsu)
	{

		$integrantes = array();

		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT CONTACTOS.Nombre, CONTACTOS.IdUsu, CONTACTOS.IdGrupo FROM (
												SELECT U.Nombre, U.IdUsu, G.IdGrupo FROM USUARIO U
												LEFT JOIN usuariogrupo G ON G.IdUsu = U.IdUsu 
												WHERE (U.IdUsu = ANY ( SELECT IdUsu1 FROM CONTACTOS WHERE IdUsu2 = '$idUsu' AND Pendiente = 0) OR U.IdUsu = ANY (SELECT IdUsu2 FROM CONTACTOS WHERE IdUsu1 = '$idUsu' AND Pendiente = 0))
												ORDER BY G.IdGrupo = '$idGrupo' DESC LIMIT 1000
											) AS CONTACTOS GROUP BY CONTACTOS.IdUsu");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
				
				$integrantes[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $integrantes;
	}	
	
	
	public function getIntegrantesGrupo($idGrupo)
	{
		$integrantes = array();
		$i = 0;

		$sentence = $this -> dbc->prepare("SELECT U.IdUsu, U.Nombre FROM USUARIO U 
											JOIN USUARIOGRUPO G ON U.IdUsu = G.IdUsu 
											WHERE G.IdGrupo = '$idGrupo'");

		if ($sentence->execute()):
			while ($row = $sentence->fetch()):
				
				$integrantes[$i] = $row;
				$i++;
		
			endwhile;
		endif;

		return $integrantes;	

	}

	
	public function anadirGrupo($nombre, $integrantes)
	{

		$sentence = $this -> dbc->prepare("INSERT INTO GRUPO(IdGrupo, Nombre, Foto) VALUES (NULL,'$nombre','../assets/groups/default.png'); 
											SELECT @@IDENTITY AS IdGrupo;");
		
		if($sentence->execute()):
		
			$sentence = $this -> dbc->prepare("SELECT @@IDENTITY AS IdGrupo;");
			$sentence->execute();
			$idGrupo=$sentence->fetch();
		
			foreach ($integrantes as $integrante):
		
				$sentence = $this -> dbc->prepare("INSERT INTO USUARIOGRUPO(IdGrupo, IdUsu) VALUES ('$idGrupo[0]','$integrante')");
				if(!$sentence->execute()):
					return false;
				endif;
					
			endforeach;
		
			return true;
		else:
			return false;	
		endif;
	
	}	


	public function modificarGrupo($idGrupo, $nombre, $integrantes)
	{
		
		$sentence = $this -> dbc->prepare("UPDATE GRUPO SET Nombre='$nombre' WHERE IdGrupo='$idGrupo'");
		
		if($sentence->execute()):
		
			$sentence = $this -> dbc->prepare("DELETE FROM USUARIOGRUPO WHERE IdGrupo='$idGrupo'");
			$sentence->execute();
		
			//$sentence = $this -> dbc->prepare("SELECT @@IDENTITY AS IdGrupo;");
		
			foreach ($integrantes as $integrante):
		
				$sentence = $this -> dbc->prepare("INSERT INTO USUARIOGRUPO(IdGrupo, IdUsu) VALUES ('$idGrupo','$integrante')");
				if(!$sentence->execute()):
					return false;
				endif;
					
			endforeach;
		
			return true;
		else:
			return false;	
		endif;
	
	}		
	
	
	public function salirGrupo($idGrupo, $idUsu)
	{
		$sentence = $this -> dbc->prepare("DELETE FROM USUARIOGRUPO WHERE IdGrupo = '$idGrupo' AND IdUsu = '$idUsu'");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
		
	}		
	
	
	public function borrarGrupo($idGrupo)
	{
		$sentence = $this -> dbc->prepare("DELETE FROM USUARIOGRUPO WHERE IdGrupo = $idGrupo;");

		if ($sentence->execute()):		
			$sentence = $this -> dbc->prepare("DELETE FROM GRUPO WHERE IdGrupo = $idGrupo;");

			if ($sentence->execute()):
				return true;
			else:
				return false;
			endif;
		endif;

	}		
	
	public function actualizarFotoGrupo($idGrupo, $Destino)
	{

		$sentence = $this -> dbc->prepare("UPDATE GRUPO SET Foto='$Destino' WHERE IdGrupo = $idGrupo");

		if ($sentence->execute()):
			return true;
		else:
			return false;
		endif;
	
	}	
	
	
}
?>

