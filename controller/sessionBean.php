<?php


class SessionBean{

    public function __construct(){

		session_start();
		
/* Control de Session por tiempo de uso		
        if (isset($_SESSION['Usuario'])){
            		
			if (time() >= $_SESSION['Expire'] ){
				$this->closeSession();
			}  		
        }
*/		
    }

    public function setActualUsuario($usuario){

        $q = new LibraryQueries();

        $_SESSION['Usuario']=$usuario;
        $_SESSION['Id']= $q -> getIdUsuario($usuario);
        $_SESSION['Start']= time();
        $_SESSION['Expire'] = $_SESSION['Start'] + (30*60);
		
    }

    public function getActualUsuario(){

        return $_SESSION['Usuario'];
    }

    public function getIdActualUsuario(){

        return $_SESSION['Id'];
    }


    public function closeSession(){

        session_unset();
        session_destroy();
    }




}

?>