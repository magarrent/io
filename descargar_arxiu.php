<?php

require_once "includes/bd.php";

  if (!isset($_SESSION['usuari'])) {
    header("Location:login.php");
  }

  $sql_usuari = "SELECT idUsuari FROM apt_usuaris WHERE usuari = '".$_SESSION['usuari']."'";
  $query_usuari = mysql_query($sql_usuari);
  $array_usuari = mysql_fetch_assoc($query_usuari);
 
if (!isset($_GET['file']) || empty($_GET['file'])) {
 exit();
}
$root = "usuaris/".$array_usuari['idUsuari']."/";
$file = basename($_GET['file']);
$path = $root.$file;
$type = '';
 
if (is_file($path)) {
 $size = filesize($path);
 if (function_exists('mime_content_type')) {
 $type = mime_content_type($path);
 } else if (function_exists('finfo_file')) {
 $info = finfo_open(FILEINFO_MIME);
 $type = finfo_file($info, $path);
 finfo_close($info);
 }
 if ($type == '') {
 $type = "application/force-download";
 }
 // Definir headers
 header("Content-Type: $type");
 header("Content-Disposition: attachment; filename=$file");
 header("Content-Transfer-Encoding: binary");
 header("Content-Length: " . $size);
 // Descargar archivo
 readfile($path);
} else {
 die("Error");
}
 
?>