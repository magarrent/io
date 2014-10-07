<?php

  require_once "includes/bd.php";

  if (!isset($_SESSION['usuari'])) {
    header("Location:login.php");
  } else {

    $noti = "";

    $sql_usuari = "SELECT idUsuari FROM apt_usuaris WHERE usuari = '".$_SESSION['usuari']."'";
    $query_usuari = mysql_query($sql_usuari);
    $array_usuari = mysql_fetch_assoc($query_usuari);

    if (isset($_POST['btn_afegir_curs'])) {
      $sql_nou_curs = "INSERT INTO apt_cursos (idUsuari, Nom) VALUES ('".mysql_real_escape_string($array_usuari['idUsuari'])."', '".$_POST['nom_curs']."')";
      $query_nou_curs = mysql_query($sql_nou_curs);
      if ($query_nou_curs) {
        $noti = "<script>$.growl({icon: 'glyphicon glyphicon-info-sign',message: ' Curs afegit correctament.'},{type: 'success'});</script>";
      }
    }

    $sql_cursos = "SELECT * FROM apt_cursos WHERE idUsuari = '".mysql_real_escape_string($array_usuari['idUsuari'])."'";
    $query_cursos = mysql_query($sql_cursos);


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

    <section class="principal row">
      
      <article>

        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="glyphicon glyphicon-tasks"></i> Els meus cursos</h3>
              <a data-toggle="modal" data-target="#afegir_curs"><span class="text_dreta"><img src="img/add.png"> Afegir curs</span></a>
            </div>
            <div class="panel-body" style="padding:0;">
              <div class="list-group" style="margin:0;">
                <?php

                  if (mysql_num_rows($query_cursos) != 0) {
                    while ($array_cursos = mysql_fetch_assoc($query_cursos)) {
                      echo "<div class='list-group-item'>";
                      echo "<a href='cursos.php?curs=".$array_cursos['identificador']."' id='curs_".$array_cursos['identificador']."' class=''>".$array_cursos['Nom']."</a>";
                      echo "</div>";
                    }
                  } else {
                    echo "<p class='titol_sense_re'>Afegeix un nou curs!</p>";
                  }

                ?>
              </div>
            </div>
          </div>
        </div>

      </article>

      <article>
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="glyphicon glyphicon-link"></i> Llocs d'interès</h3>
              <a href=""><span class="text_dreta"><img src="img/add.png"> Afegir enllaç</span></a>
            </div>
            <div class="panel-body">
              <a href="">
                <div class="col-md-4 llocs_interes">
                  <img src="img/wikipedia.png" class="img-responsive">
                  <p>Wikipedia</p>
                </div>
              </a>  
              <a href="">  
                <div class="col-md-4 llocs_interes">
                  <img src="img/wikipedia.png" class="img-responsive">
                  <p>Wikipedia</p>
                </div>
              </a>    
              <a href="">  
                <div class="col-md-4 llocs_interes">
                  <img src="img/wikipedia.png" class="img-responsive">
                  <p>Wikipedia</p>
                </div>
              </a>
            </div>
          </div>
        </div>

      </article>
    </section>  

    <section class="row">
      <article>
        <div class="col-md-7">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="icon-alarma"></i> Recordatoris </h3>
              <a href=""><span class="text_dreta"><img src="img/add.png"> Afegir recordatori</span></a>
            </div>
            <div class="panel-body centrat">
             <a href=""><div class="recordatori_ok col-md-3">
               <i class="icon-alarma"></i>
               <span class="normal">Trucar iaia</span>
               <span class="petit">03/09/2014</span>
             </div></a>

             <a href=""><div class="recordatori col-md-3">
               <i class="icon-alarma"></i>
               <span class="normal">Trucar iaia</span>
               <span class="petit">03/09/2014</span>
             </div></a>
            </div>
          </div>
        </div>
      </article>

      <article>
        <div class="col-md-5">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="glyphicon glyphicon-send"></i> Enviar missatges a altres usuaris</h3>
            </div>
            <div class="panel-body">
              <form name="enviar_missatge" id="enviar_missatge" method="POST">
                <div class="col-md-5"><label for="nom"><input type="text" name="nom" id="nom" class="form-control" placeholder="Usuari destinatari..."></label></div>
                <div class="col-md-7"><label for="nom"><input type="file" name="arxiu" id="arxiu" class="form-control" placeholder="Arxius adjunts"></label><br/></div>
                <div class="col-md-12"><textarea class="form-control textarea_bold" rows="4" name="missatge" id="missatge" placeholder="Missatge..."></textarea><br/></div>
                <div class="col-md-12"><input type="submit" name="submit" value="Enviar missatge" class="btn btn-info form-control"></div>
              </form>
            </div>
          </div>
        </div>
      </article>  
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.confirm.min.js"></script>
    <?php
      include "afegir/afegir.php";
    ?>

    <script>
      $(".list-group-item").hover(function() {
        $(this).append("<button id='borrar_curs_btn' class='btn btn-default icon_borrar btn-xs'><i class='glyphicon glyphicon-remove'></i></button>");

          $("#borrar_curs_btn").confirm({
              title: "Segur que vols eliminar el curs seleccionat?",
              text: "Si borres aquest curs, tot el seu contingut es borrara.",
              confirm: function(button) {
                  var $id = $(".list-group-item a").attr('id');
                  $id = $id.split('_')[1];
                  $.post("borrar_curs.php", {curs:$id,usuari:<?= mysql_real_escape_string($array_usuari['idUsuari']) ?>}, function() {
                    location.reload();
                    return false;
                  });
              },
              cancel: function(button) {
                  // do something
              },
              confirmButton: "Sí!",
              cancelButton: "No",
              post: true
          });

      }, function () {
        $(this).find("button:last").remove();
      });

    </script>

    <script src="js/bootstrap-growl.min.js"></script>

    <?= $noti ?>

  </body>
</html>