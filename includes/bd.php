<?php

	$con = mysql_connect("localhost", "root", "patata");

	if (mysql_select_db("apuntic", $con)) {
	 	session_start();
	 } else {
	 	session_destroy();
	 }

?>