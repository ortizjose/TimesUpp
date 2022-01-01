 <?php 
include '..\model\bdConnection.php';
include '..\controller\sessionBean.php';
	
   $q = new LibraryQueries();
   $s = new SessionBean();

    if(empty($q->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['Usuario']) ){

		$usuario = $_POST['Usuario'];
		$contrasena = $_POST['Contrasena'];      

		$res = $q->comprobarLogin($usuario, $contrasena);

		if($res==true)
		{
				$s->setActualUsuario($usuario);

		    header('Location: ..\views\index.php');
			//header('Location: ..\views\login.php');
		}
		else{

			header('Location: ..\views\login.php?login=error');
		}

    }
 ?>