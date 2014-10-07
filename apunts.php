<?php

  require_once "includes/bd.php";

  if (!isset($_SESSION['usuari'])) {
    header("Location:login.php");
  } else {

    if (!isset($_GET['n'])) {
      header("Location:index.php");
    } else {

      $noti = "";

      $sql_usuari = "SELECT idUsuari FROM apt_usuaris WHERE usuari = '".$_SESSION['usuari']."'";
      $query_usuari = mysql_query($sql_usuari);
      $array_usuari = mysql_fetch_assoc($query_usuari);

      // Nou arxiu

      if (isset($_POST['btn_afegir_arxiu'])) {

        $name_arxiu = $_FILES['arxiu']['name'];
        $size_arxiu = $_FILES['arxiu']['size'] / 1024;
        $type_arxiu = $_FILES['arxiu']['type'];
        $tmp_arxiu = $_FILES['arxiu']['tmp_name'];

        $desti = "usuaris/".$array_usuari['idUsuari']."/".$name_arxiu;

        if ($size_arxiu <= 6242880 / 1024) {
            if (!file_exists("usuaris/".$array_usuari['idUsuari'])) {
            mkdir("usuaris/".$array_usuari['idUsuari'], 755);
              
              if (move_uploaded_file($tmp_arxiu, $desti)) {
              $sql_nou_arxiu = "INSERT INTO apt_arxius (idApunts, idUsuari, Nom) VALUES ('".mysql_real_escape_string($_GET['n'])."', '".$array_usuari['idUsuari']."', '".htmlentities($name_arxiu)."')";
              $query_nou_arxiu = mysql_query($sql_nou_arxiu);

              if ($query_nou_arxiu) {
                $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Apunts afegits correctament.'},{type: 'success'});</script>";
              }
            }

          } else {
            if (move_uploaded_file($tmp_arxiu, $desti)) {


              $sql_nou_arxiu = "INSERT INTO apt_arxius (idApunts, idUsuari, Nom) VALUES ('".mysql_real_escape_string($_GET['n'])."', '".$array_usuari['idUsuari']."', '".htmlentities($name_arxiu)."')";
              $query_nou_arxiu = mysql_query($sql_nou_arxiu);

              if ($query_nou_arxiu) {
                $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Apunts afegits correctament.'},{type: 'success'});</script>";
              }
            }
          }
        } else {
          $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Arxiu massa gran!.'},{type: 'danger'});</script>";

        }
        
      }






      $sql_apunts = "SELECT * FROM apt_apunts WHERE identificador = '".mysql_real_escape_string($_GET['n'])."'";
      $query_apunts = mysql_query($sql_apunts);

      $sql_arxius = "SELECT * FROM apt_arxius WHERE idApunts = '".mysql_real_escape_string($_GET['n'])."' && idUsuari = '".$array_usuari['idUsuari']."'";
      $query_arxius = mysql_query($sql_arxius);

      if (mysql_num_rows($query_apunts) != 0) {
        $array_apunts = mysql_fetch_assoc($query_apunts);

        $sql_comprobar_curs = "SELECT * FROM apt_cursos WHERE identificador = '".$array_apunts['idCurs']."' && idUsuari = '".mysql_real_escape_string($array_usuari['idUsuari'])."'";
        $query_comprobar_curs = mysql_query($sql_comprobar_curs);

        if (mysql_num_rows($query_comprobar_curs) != 0) {
          $array_comprobar_curs = mysql_fetch_assoc($query_comprobar_curs);

          $sql_comprobar_assig = "SELECT * FROM apt_assignatures WHERE identificador = '".$array_apunts['idAssig']."' && idUsuari = '".mysql_real_escape_string($array_usuari['idUsuari'])."'";
          $query_comprobar_assig = mysql_query($sql_comprobar_assig);

          if (mysql_num_rows($query_comprobar_assig) != 0) {
            $array_comprobar_assig = mysql_fetch_assoc($query_comprobar_assig);


            if ($array_apunts['Contingut'] == "" || empty($array_apunts['Contingut'])) {
              $array_apunts['Contingut'] == "";
            }

          } else {
            header("Location:index.php");
          }

        } else {
          header("Location:index.php");
        }

      } else {
        header("Location:index.php");
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="lib/ckeditor-full/ckeditor.js"></script>
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
      <div class="page-header">
        <h1><?= $array_apunts['Nom'] ?> <small><?= $array_comprobar_assig['Nom'] ?> (<?= $array_comprobar_curs['Nom'] ?>)</small></h1>
      </div>
      <form method="POST">
        <textarea rows="30" id="contingut_apunts" name="contingut_apunts"><?= $array_apunts['Contingut'] ?></textarea>
      </form>

      <article class="row">
      <br>
      <h3>Arxius adjunts</h3>
        <?php

          while ($array_arxius = mysql_fetch_assoc($query_arxius)) {
            echo "<div class='col-md-2 centre'>";
              $extensio = explode(".", $array_arxius['Nom'])[1];
              if ($extensio == "pdf") {
                $icon = "img/icons/pdf.png";
              } else if ($extensio == "png") {
                $icon = "img/icons/png.png";
              } else if ($extensio == "word") {
                $icon = "img/icons/word.png";
              } else if ($extensio == "excel") {
                $icon = "img/icons/excel.png";
              } else {
                $icon = "img/icons/file.png";
              }
              echo "<a href='descargar_arxiu.php?file=".$array_arxius['Nom']."'><img src='".$icon."'>";
              echo "<p>".$array_arxius['Nom']."</p></a>";
              echo "<button id='arxiu_".$array_arxius['idArxiu']."' class='btn btn-danger btn-xs boton_borrar'><i class='glyphicon glyphicon-remove'></i></button>";
            echo "</div>";
          }

        ?>
      </article>
      <br/><br/><br/>
      <form method="POST" name="afegir_arxiu" enctype="multipart/form-data">
        <div class="col-md-4"><label>Nou arxiu:</label>
          <input type="file" name="arxiu" id="arxiu"></div>
        <div class="col-md-4"><br/><input type="submit" name="btn_afegir_arxiu" class="btn btn-primary" value="Afegir arxiu">  </div>
      </form>
      <br><br><br><br>
    </section>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.confirm.min.js"></script>

    <script src="js/bootstrap-growl.min.js"></script>

    <script>

    CKEDITOR.replace('contingut_apunts');

    </script>

    <script>
      $(".boton_borrar").click(function() {
        var $id = $(this).attr("id").split('_')[1];
        $.post("borrar_arxiu.php", {idArxiu:$id}, function() {
          location.reload();
          return false;
        });
      });
    </script>

    <?= $noti ?>

  </body>
</html>