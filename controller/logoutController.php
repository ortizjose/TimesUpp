<?php

include '..\controller\sessionBean.php';
	$s = new SessionBean();

	$s -> closeSession();

    header('Location: ..\views\login.php');
?>