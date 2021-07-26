<?php
	
	error_reporting(0);
  
    

  include('sqlconnector.php');

    

?>

 <!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

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
    

</head>
<body >



<?php
	include('header.php');
?>



<!-- //////////////////////////////////////////////////////////// -->
<div class="container" id="main_container"> <!-- container 2 -->

  <div class="form-group row">
          
          <div class="col-sm-10">
            
          </div>
              
          <div class="col-sm-2">
            <a href="index.php" class="btn btn-secondary">Regresar</a>
          </div>

       </div>
   

  
  <div class="row">
    <div class="col-md-12">
      <div class="card" >
        <div class="card-header">Recuperar contraseña</div>
        <div class="card-body" id="divcorreo">
            <!-- ////////////////////////////////////////////////////////////// -->


          <div class="form-horizontal">
            
            <div class="form-group" >

              <p>Escribe el correo electrónico que hayas registrado. Si existe una cuenta asociada con ese correo, se enviará la información para recuperar la contraseña.</p>

              <label class="control-label" >Correo:</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" id="correo" required>
              </div>
            </div>

            <div class="form-group">

              
              <div class="col-sm-6">
                <button class="btn btn-primary" id="btnrecuperar" onclick="fnReenviarCorreo(0);">Recuperar contraseña</button>
              </div>
            </div>
            
 
          </div>

        </div>
    </div>
  </div>
  
  
</div>

</div> <!--- /maincontainer -->


<!-- //////////////////////////////////////////////////////////// -->


<?php
	include('footer.php');
?>


</body>
</html> 

<?php



?>