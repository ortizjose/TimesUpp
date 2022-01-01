<?php

	include '../includes/session.php';

	$s = new UsuarioSession();

	$s -> closeSession();

    header('Location: ../login.php');
?>