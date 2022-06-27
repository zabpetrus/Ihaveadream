<?php
	session_start();

	unset($_SESSION['login']);
	unset($_SESSION['usuarioId']);

	header("Location: admin/login_page.php");
?>