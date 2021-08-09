<?php
	session_start();
	error_reporting(0);

  //$concurso= $_GET['concurso'];
  if(!isset($_GET['concurso'])){
    //header("Location: index.php");

  }



    $fecha1="2021-07-27 08:59:00";
    //$fecha1="2021-08-20 08:59:00";//LA BUENA
    $fecha2="2021-10-22 23:59:59";
//10 de agosto al 22 de octubre de 2021
   //	   08              10




   //echo " / ".date("Y-m-d")." / ".date($fecha1)." / ".date($fecha2);



    if(date("Y-m-d H:i:s")>=date($fecha1)&&date("Y-m-d H:i:s")<=date($fecha2)){
      //echo "dentro de rango";
      $fecha_registro="";
    }else{
      //echo "fuera de rango";
      $fecha_registro=" disabled";


       //$fecha1="-";
      //$fecha2="-";
    }



  if( isset($_POST['usr']) && isset($_POST['pwd'])){





    include('sqlconnector.php');


	$nomcompleto = "";
    $usr= $_POST['usr'];
    $pwd=$_POST['pwd'];
    $concurso= $_POST['concurso'];
    $query="SELECT * FROM ".BD_USUARIOS." WHERE usuario ='$usr' and contrasena='$pwd' ";
    $row0=sqlsrv_query($conn,$query);



    if($row= sqlsrv_fetch_array($row0)){

      $id=$row['idusuario'];

      $perfil=$row['perfil'];

      $status=$row['estatus'];

      //$area=$row['area'];

      $usr=$row['usuario'];
      $pwd=$row['contrasena'];

      $area=$row['area'];
      $distrito=$row['iddistrito'];







      if($status=='1'&&$perfil=='1'){

        $_SESSION["idusuario"] = $id;
        $_SESSION["usr"] = $usr;
        $_SESSION["pwd"] = $pwd;
        $_SESSION["nombre"]=$nombre;
  	    $_SESSION["paterno"]=$paterno;
  	    $_SESSION["materno"]=$materno;
        $_SESSION["perfil"] =$perfil;



  		    header("Location: main.php");
        //echo "true";
      }else{

        session_destroy();
		 header("Location: login.php?activado=0");
      //echo " / ".$area." // ".$concurso." / ";

	    }



      if($perfil=='3'){

          session_start();

        $_SESSION["idusuario"] = $id;
        $_SESSION["usr"] = $usr;
        $_SESSION["pwd"] = $pwd;
        $_SESSION["nombre"]=$nombre;
        $_SESSION["paterno"]=$paterno;
        $_SESSION["materno"]=$materno;
        $_SESSION["perfil"] =$perfil;

        $_SESSION["distrito"]=$distrito;




          header("Location: maincentrales.php");
        //echo "true";
      }


    }else{
      session_destroy();
		  header("Location: login.php?act=0"); ////no existe
        //echo "false";
    }

	}else{


?>

 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VOTAFILMFEST</title>

	 <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/holder.min.js"></script>-->
    <script src="js/funcionesajax.js"></script>
     <link rel="stylesheet" href="css/all.css">


</head>
<body >



<?php
	include('header.php');
?>


<!-- //////////////////////////////////////////////////////////// -->
<div class="container" id="main_container"> <!-- container 2 -->

<div class="container">




  <div class="row">
     <div class="col-sm-10">
       <h1>Vota<b>film</b>fest</h1>
     </div>
     <div class="col-sm-2">
        <a href="index.php" class="btn btn-secondary">Regresar</a>
     </div>
  </div>


  <div class="row">
    <div class="col-md-5">
      <div class="card" >
        <div class="card-header">Ingreso</div>
        <div class="card-body">
            <!-- ////////////////////////////////////////////////////////////// -->


          <form class="form-horizontal" id="loginform"  action="login.php" method="post">
            <input type="hidden" name="concurso" value="<?php echo $concurso;?>">
            <div class="form-group">

             <!-- <label class="control-label" for="usr">Usuario:</label>-->
              <div class="col-sm-12">
                <input type="text" class="form-control" id="usr" name="usr" placeholder="Nombre de usuario" required>
              </div>
            </div>
            <div class="form-group">
              <!-- <label class="control-label" for="pwd">Password:</label>-->
              <div class="col-sm-12">
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Contraseña" required>
              </div>
            </div>
              <div class="form-group">
              <div class="col-sm-12">
              <button type="submit" name="submit" class="btn btn-primary btn-block" >Ingresar</button>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                  <button type="button" class="btn btn-light btn-block" onclick="location.href='recuperarcontrasena.php'">Recuperar contraseña</button>
              </div>
            </div>

  <?php
            if( isset($_GET['act'])){
               echo '<div class="alert alert-success" align="center">Usuario o contraseña no existe</div>';
            }
  	   if( isset($_GET['activado'])){
               echo '<div class="alert alert-success" align="center">Usuario NO Activo</div>';
            }
  ?>
          </form>

        </div>
    </div>
  </div>

  <div class="col-md-2">
  </div>

  <div class="col-md-5">
    <div class="row" id="anim">
      <div class="bg-primary text-white anim1">
        ¿Eres nuevo aquí? Primero regístrate  <i class="fas fa-long-arrow-alt-down"></i>
      </div>

    </div>
    <div class="card">
      <div class="card-header">Nuevo usuario</div>
      <div class="card-body">

        <div class="form-group">
          <form action="usuarios.php" method="post" >
            <div class="col">
              <input type="hidden" name="concurso" value="<?php echo $concurso;?>">

              <button type="submit" class="btn btn-primary btn-block"  <?php echo $fecha_registro;?> >Registro de usuario</button>
            </div>
            <hr>
            <div class="col">

              <p> Periodo de registro:</p> <p><b>Del 20 de agosto al 22 de octubre de 2021</b></p>
              <!-- <p><?php echo date($fecha1)." - ".date("Y-m-d H:i:s");?></p>-->
            </div>
          </form>

          </div>



      </div>
    </div>
    <div class="m-5" ><a href="documentos_descarga/convocatoria.pdf" target="_blank">Consulta la convocatoria</a></div>
  </div>

  </div> <!-- row -->

  <div class="row"><!-- row 2 -->


      <div class="card" style="width:100%;">
        <div class="card-header">
          <button class="btn btn-secondary btn-block" type="button" data-toggle="collapse" data-target="#collapse1">
            Formatos para descarga
          </button>
        </div>
      <div class="card-body">
      <div class="collapse" id="collapse1">
        <div class="d-flex justify-content-center"><p>Descarga los siguientes formatos y llénalos con tinta azul.</p></div>





                <?php

                              echo '<div class="row">';
                               echo '<div class="col-sm-6">';
                               echo '<p>Menores de edad (12 a 17 años)</p>';

                                echo ' <div class="row" >
                                        <div class="col-sm-1">
                                            <i class="far fa-file-pdf"></i>
                                        </div>
                                        <div class="col-sm-11">
                                          <a href="descargarword.php?f='.base64_encode('documentos_descarga/cartacesion_cat1.docx').'" target="_blank">1. Carta de cesión de derechos</a>
                                        </div>
                                      </div>';



                                echo ' <div class="row">
                                            <div class="col-sm-1">
                                              <i class="far fa-file-pdf"></i>
                                            </div>
                                            <div class="col-sm-11">
                                              <a href="descargarword.php?f='.base64_encode('documentos_descarga/declaracion_verdad.docx').'" target="_blank">2. Carta bajo protesta de decir verdad que la obra es original, personal e inédita.</a>
                                            </div>
                                      </div>';
                                 echo '</div>'; //col-sm-6





                               echo '<div class="col-sm-6">';
                                 echo '<p>Mayores de edad (18 a 29 años)</p>';


                                echo ' <div class="row">
                                        <div class="col-sm-1">
                                            <i class="far fa-file-pdf"></i>
                                        </div>
                                        <div class="col-sm-11">
                                          <a href="descargarword.php?f='.base64_encode('documentos_descarga/cartacesion_cat2.docx').'" target="_blank">1. Carta de cesión de derechos.</a>
                                        </div>
                                      </div>';



                                echo ' <div class="row">
                                            <div class="col-sm-1">
                                              <i class="far fa-file-pdf"></i>
                                            </div>
                                            <div class="col-sm-11" ><a href="descargarword.php?f='.base64_encode('documentos_descarga/declaracion_verdad.docx').'" target="_blank">2. Carta bajo protesta de decir verdad que la obra es original, personal e inédita.</a>
                                            </div>
                                        </div>';

                                  echo '</div>'; //col-sm-6

                                 echo '</div>'; //row

                                 echo '<hr>';

                                 echo '<div class="m-5" ><a href="documentos_descarga/convocatoria.pdf" target="_blank">Consulta la convocatoria</a></div>';








?>





    </div><!---collapse -->
  </div><!--card body -->
  </div><!---card-->
</div><!--- row2 -->






</div><!-- otro container -->





</div> <!--- /maincontainer -->

<!-- //////////////////////////////////////////////////////////// -->


<?php
	include('footer.php');
?>


</body>
</html>

<?php

}//////else default

?>
