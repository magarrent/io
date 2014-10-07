<?php

	require_once "includes/bd.php";

	if (session_destroy()) {
		header("Location:login.php");
	}

?>