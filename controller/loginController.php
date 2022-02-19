 <?php 
include '..\controller\sessionBean.php';
include '..\model\usuarioDB.php';

   $u = new UsuarioDB();
   $s = new SessionBean();

    if(empty($u->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['Usuario']) ){

		$usuario = $_POST['Usuario'];
		$contrasena = $_POST['Contrasena'];      

		$res = $u->comprobarLogin($usuario, $contrasena);

		
		if(!$res): // Usuario no existe
			header('Location: ..\views\error.php');
		
		elseif( $res == 1 ): // Usuario OK
			$s->setActualUsuario($usuario);
		    header('Location: ..\views\index.php');
		
		else:// Usuario no existe o contraseña incorrecta
			header('Location: ..\views\login.php?login='.urlencode($res));
		endif;

    }
 ?>