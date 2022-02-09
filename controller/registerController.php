 <?php 
include '..\model\usuarioDB.php';
include '..\controller\sessionBean.php';
	
   $u = new UsuarioDB();
   $s = new SessionBean();

    if(empty($u->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['Nombre']) ){

		if (strnatcmp($_POST['Contrasena'], $_POST['ContrasenaConf']) != 0):

			header('Location: ..\views\register.php?register=error1');
		
		endif;
		
		$nombre=$_POST['Nombre'].' '.$_POST['Apellido'];
		$res = $u->registrarUsuario($_POST['Usuario'], $nombre, $_POST['Contrasena'], $_POST['Email']);
		
		if($res==1):
		
		    header('Location: ..\views\register.php?register=success');
		
		elseif($res == -1):

			header('Location: ..\views\register.php?register=error2');

		elseif($res==-2):

			header('Location: ..\views\register.php?register=error3');
				
		
		
		endif;
		
    }
 ?>