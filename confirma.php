<?php
//session_start();
//if (date("Y-m-d H:i")<="2019-02-10 23:59")// para cerrar el sistema en automatico
	
//{
include('sqlconnector.php');
	

$id_h= base64_decode($_GET["f1"]);
	
//$usr=$_GET["u"];
//$pwd=$_GET["c"];

//$id_h=38;
	//$sql="update sispe_aspirantes set estado=2 where id_hash= '$id_h';";
	$sql= "update ".BD_USUARIOS." set estatus=1 where idusuario= $id_h ";

//sqlsrv_prepare($sql);


$s = sqlsrv_prepare($conn, $sql);
$r=sqlsrv_execute($s);
	
	
	
	
if($r){

	?>
    <!--
    <script>alert("Bienvenido, ingrese todos sus datos y documentación para quedar registrado");</script>

	<script>window.location.replace("login.php?");</script>
	-->



	<!doctype html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   
    <title> </title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/holder.min.js"></script>-->
    <script src="js/funciones.js"></script>
    <link rel="stylesheet" href="css/all.css">

    




  </head>

  <body class="">

    <?php
      include("header.php");
    ?>

    <div class="container" id="main_container">

      
       <hr>
      <div class="alert alert-success alert-dismissible">
                Usuario activado con éxito
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>

      <div class="row justify-content-md-center">
      	<a class="btn btn-primary" href="index.php">Ingresa con tu usuario y contraseña para continuar con el registro</a>
      </div>
      <hr>

     

    
      
      
    </div>

    
    <?php
      include("footer.php");
    ?>
  </body>
</html>
	
    <?php
 }else{
       
         if( ($errors = sqlsrv_errors() ) != null) {
			 foreach( $errors as $error ) {
			 echo $error[ 'message']."<br />";
			 }
		 }
			
 }
			
//	}
//else
//{
	//echo "<script>alert('Sistema cerrado')</script>";
//}	

?>
