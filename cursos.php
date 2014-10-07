<?php

  require_once "includes/bd.php";

  if (!isset($_SESSION['usuari'])) {
    header("Location:login.php");
  } else {

    if (!isset($_GET['curs'])) {
      header("Location:index.php");
    } else {

      $noti = "";

      $sql_usuari = "SELECT idUsuari FROM apt_usuaris WHERE usuari = '".$_SESSION['usuari']."'";
      $query_usuari = mysql_query($sql_usuari);
      $array_usuari = mysql_fetch_assoc($query_usuari);

      if (isset($_POST['btn_afegir_assig'])) {
        $sql_nova_assig = "INSERT INTO apt_assignatures (idCurs, idUsuari, Nom) VALUES ('".mysql_real_escape_string($_GET['curs'])."', '".mysql_real_escape_string($array_usuari['idUsuari'])."', '".htmlentities($_POST['nom_assig'])."')";
        $query_nova_assig = mysql_query($sql_nova_assig);
        if ($query_nova_assig) {
          $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Assignatura afegida correctament.'},{type: 'success'});</script>";
        }
      }

      $comprobar_curs = "SELECT * FROM apt_cursos WHERE idUsuari = '".$array_usuari['idUsuari']."' && identificador = '".mysql_real_escape_string($_GET['curs'])."'";
      $query_comprobar_curs = mysql_query($comprobar_curs);

      if (mysql_num_rows($query_comprobar_curs) != 0) {
        $sql_sel_assig = "SELECT * FROM apt_assignatures WHERE idCurs = '".mysql_real_escape_string($_GET['curs'])."' && idUsuari = '".mysql_real_escape_string($array_usuari['idUsuari'])."'";
        $query_sel_assig = mysql_query($sql_sel_assig);
      } else {
        header("Location:index.php");
      }

      if (isset($_POST['btn_afegir_apunts'])) {

        $name_arxiu = $_FILES['arxiu']['name'];
        $size_arxiu = $_FILES['arxiu']['size'] / 1024;
        $type_arxiu = $_FILES['arxiu']['type'];
        $tmp_arxiu = $_FILES['arxiu']['tmp_name'];

        $desti = "usuaris/".$array_usuari['idUsuari']."/".$name_arxiu;

        if ($size_arxiu <= 10000000) {
            if (!file_exists("usuaris/".$array_usuari['idUsuari'])) {
            mkdir("usuaris/".$array_usuari['idUsuari'], 755);
              
              if (move_uploaded_file($tmp_arxiu, $desti)) {
              
              $sql_nou_apunt = "INSERT INTO apt_apunts (idCurs, idAssig, idUsuari, Nom, Contingut) VALUES ('".mysql_real_escape_string($_GET['curs'])."', '".mysql_real_escape_string($_POST['assig'])."', '".mysql_real_escape_string($array_usuari['idUsuari'])."', '".htmlentities($_POST['titol'])."', '".htmlentities($_POST['contingut'])."')";
              $query_nou_apunt = mysql_query($sql_nou_apunt);

              $sql_ultim_apunt = "SELECT identificador FROM apt_apunts ORDER BY identificador DESC";
              $array_ultim_apunt = mysql_fetch_assoc(mysql_query($sql_ultim_apunt));

              $ultim_apunt = $array_ultim_apunt['identificador'] + 1;

              $sql_nou_arxiu = "INSERT INTO apt_arxius (idApunts, idUsuari, Nom) VALUES ('".$ultim_apunt."', '".$array_usuari['idUsuari']."', '".htmlentities($name_arxiu)."')";
              $query_nou_arxiu = mysql_query($sql_nou_arxiu);

              if ($query_nou_apunt && $query_nou_arxiu) {
                $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Apunts afegits correctament.'},{type: 'success'});</script>";
              }
            }

          } else {
            if (move_uploaded_file($tmp_arxiu, $desti)) {
              
              $sql_nou_apunt = "INSERT INTO apt_apunts (idCurs, idAssig, idUsuari, Nom, Contingut) VALUES ('".mysql_real_escape_string($_GET['curs'])."', '".mysql_real_escape_string($_POST['assig'])."', '".mysql_real_escape_string($array_usuari['idUsuari'])."', '".htmlentities($_POST['titol'])."', '".htmlentities($_POST['contingut'])."')";
              $query_nou_apunt = mysql_query($sql_nou_apunt);

              $sql_ultim_apunt = "SELECT identificador FROM apt_apunts ORDER BY identificador DESC";
              $array_ultim_apunt = mysql_fetch_assoc(mysql_query($sql_ultim_apunt));

              $ultim_apunt = $array_ultim_apunt['identificador'] + 1;

              $sql_nou_arxiu = "INSERT INTO apt_arxius (idApunts, idUsuari, Nom) VALUES ('".$ultim_apunt."', '".$array_usuari['idUsuari']."', '".htmlentities($name_arxiu)."')";
              $query_nou_arxiu = mysql_query($sql_nou_arxiu);

              if ($query_nou_apunt && $query_nou_arxiu) {
                $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Apunts afegits correctament.'},{type: 'success'});</script>";
              }
            }
          }
        } else {
          $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Arxiu massa gran!.'},{type: 'danger'});</script>";

        }
        
      }

    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header class="navbar navbar-inverse" id="top" role="banner">
      <div class="container">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="./" class="navbar-brand">Apuntic</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-wrench"></i> <?= $_SESSION['usuari'] ?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="logout.php">Desconectar</a></li>
              </ul>
            </li>
          </ul>

        </nav>
      </div>
    </header>

    <section class="principal row container">
      <article class="col-md-3 assignatures_list">

        <h4 data-toggle="modal" data-target="#afegir_assig" class="add_assig"><img src="img/add.png" width="20"> Afegir assignatures</h4>
        <ul class="nav nav-pills nav-stacked">          
          <?php

            while ($array_assig = mysql_fetch_assoc($query_sel_assig)) {
              echo "<li class='sel_assig' id='assig_".$array_assig['identificador']."'><a>".$array_assig['Nom']." <i class='glyphicon glyphicon-chevron-right icono_dreta'></i></a></li>";
            }

          ?>
        </ul>
      </article> 
        <div id="add_apunts" style="display:none;"></div>
      <article class="col-md-9">
        <h4 align="center" id="seleccionar_assig"><i class="glyphicon glyphicon-circle-arrow-left"></i> Selecciona una assignatura</h4>
        <div id="apunts" style="display:none;">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title">Llistat de apunts</h3>
            </div>
            <div class="panel-body">
              <ul class="list-group" id="llista_apunts">
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
              </ul>
            </div>
          </div>
        </div>
      </article>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.confirm.min.js"></script>

    <script src="js/bootstrap-growl.min.js"></script>
    <script src="lib/ckeditor-mid/ckeditor.js"></script>

    <?php
      require "afegir/afegir_assig.php";
      require "afegir/afegir_apunt.php";
    ?>


    <script>


      $(".nav-stacked li").click(function (event) {
            event.preventDefault();

            $("#seleccionar_assig").hide();

            $(".nav-stacked li").removeClass("active");

            $("#apunts").hide();  

            var $id = $(this).attr("id").split('_')[1];

            $(".agafar_id_assig").attr("value",$id);
         
            $.ajax({
                type: "POST",
                url: "peticions/request_assig.php",
                data: "identificador="+$id+"&curs="+<?= mysql_real_escape_string($_GET['curs']) ?>+"&usuari="+<?= mysql_real_escape_string($array_usuari['idUsuari']) ?>,
                dataType: "json",
                success: function(msg, string, jqXHR) {
                  $("#add_apunts").html("<h4 data-toggle='modal' data-target='#afegir_apunts' class='add_assig'><img src='img/add.png' width='20'> Afegir apunts</h4>")
                  $("#assig_"+$id).addClass("active");
                  $("#llista_apunts").html("");
                  if (msg[1][0]) {
                    for (i in msg) {
                      alert(msg[1]);
                      $("#llista_apunts").append("<a href='apunts.php?n="+msg[1][i]+"' class='list-group-item'>"+msg[0][i]+"</a>");
                    }
                  } else {
                      $("#llista_apunts").append("<h4 class='italic_center'>No tens apunts a l\'assignatura seleccionada.</h4>")
                  };
                    $("#add_apunts").show("slow");
                    $("#apunts").show("slow");
                }
            }); 
        });

    CKEDITOR.replace('contingut');

    </script>

    <?= $noti ?>

  </body>
</html>