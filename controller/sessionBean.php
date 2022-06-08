<?php

class SessionBean{

    public function __construct(){

		session_start();
		
// Control de Session por tiempo de uso		
        if (isset($_SESSION['Usuario'])){
            		
			if (time() >= $_SESSION['Expire'] && $_SESSION['Recuerda']==0 ){
				$this->closeSession();
			}  		
        }
		
    }

    public function setActualUsuario($usuario, $guardarSesion){

        $u = new UsuarioDB();
		
		$usuarioActual = $u -> getUsuario($u -> getIdUsuario($usuario));

        $_SESSION['Usuario']=$usuario;
		$_SESSION['Nombre']= $usuarioActual[0]['Nombre'];
        $_SESSION['Id']= $usuarioActual[0]['IdUsu'];
        $_SESSION['Start']= time();
        $_SESSION['Expire'] = $_SESSION['Start'] + (30*60); // 30 min
		$_SESSION['Foto'] = $usuarioActual[0]['Foto']; 
		$_SESSION['Nota'] = $usuarioActual[0]['NotaRapida'];
		$_SESSION['Recuerda'] = $guardarSesion;
		
    }

    public function getActualUsuario(){

        return $_SESSION['Usuario'];
    }
	
	public function getNombreActualUsuario(){
		return $_SESSION['Nombre'];		
	}

    public function getIdActualUsuario(){

        return $_SESSION['Id'];
    }
	
	public function getFotoActualUsuario(){
		return $_SESSION['Foto'];
	}
	
	public function getNotaActualUsuario(){
		return $_SESSION['Nota'];
	}
	
	public function setFotoActualUsuario($foto){
		 $_SESSION['Foto']=$foto;
	}
	
    public function closeSession(){

        session_unset();
        session_destroy();
    }




}

?>