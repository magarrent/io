<?php

	require_once "includes/bd.php";

	if (!isset($_SESSION['usuari'])) {
		header("Location:login.php");
	}

?>