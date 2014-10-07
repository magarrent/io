<?php

	require_once "../includes/bd.php";

	$identificador = mysql_real_escape_string($_REQUEST['identificador']);
    $curs = mysql_real_escape_string($_REQUEST['curs']);
    $usuari = mysql_real_escape_string($_REQUEST['usuari']);

	$sql_text = "SELECT * FROM apt_apunts WHERE idAssig = '".$identificador."' && idCurs = '".$curs."' && idUsuari = '".$usuari."'";
	$query_text = mysql_query($sql_text);

    //$list = array('identificador'=>$identificador); 

    $list1 = [];
    $list2 = [];

    while ($array_text = mysql_fetch_assoc($query_text)) {
    	array_push($list1, $array_text['Nom']);
    	array_push($list2, $array_text['identificador']);
    }

    $c = json_encode(array($list1, $list2)); 

    echo $c; 

?>