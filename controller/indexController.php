 <?php 
include '..\controller\sessionBean.php';
include '..\model\eventoDB.php';
$s = new SessionBean();
$e = new EventoDB();

	$idUsu = $s -> getIdActualUsuario();

    if(empty($e->dbc)){
        echo "<h3 align='center'>¡Error!: No se pudo establecer la conexión con la base de datos.</h3><br/>";
        die();
    }

    if ( !empty($_POST['eventoNombre']) ){
		
		if ( $_POST['eventoFecha1'] > $_POST['eventoFecha2'] && !empty($_POST['eventoFecha2'])):

			header('Location: ..\views\index.php?evento=-1');
		elseif (!empty($_POST['eventoGrupal'])):

			$_POST['eventoGrupal']= 1;
		else: 

			$_POST['eventoGrupal']= NULL;
		endif;
		
		$res = $e -> anadirEvento($_POST['eventoNombre'], $_POST['eventoEtiqueta'] , $_POST['eventoDescrip'], $_POST['eventoFecha1'], $_POST['eventoFecha2'], $idUsu, $_POST['eventoActividad'], $_POST['eventoGrupal']);
		
		if($res):			
				header('Location: ..\views\index.php?evento=1');
		else:
				header('Location: ..\views\error.php');
		endif;

		
    }
 ?>