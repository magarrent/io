<?php

	require_once "includes/bd.php";

	$curs = mysql_real_escape_string($_POST['curs']);
	$usuari = mysql_real_escape_string($_POST['usuari']);

	$sql_borrar_curs = "DELETE FROM apt_cursos WHERE identificador = '".$curs."' && idUsuari = '".$usuari."'";
	mysql_query($sql_borrar_curs);

?>