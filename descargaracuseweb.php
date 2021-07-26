<?php

 include('sqlconnector.php');
 include('rutasitio.php');

 $folio_64=$_GET['v'];

 $folio_string=base64_decode($folio_64);

 $folio=str_replace("/jF5i/","",$folio_string);
  
  

  
?>
<html>
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

<body>
	
	
	<div class="container" id="topmenu">
    
    
  
</div>
	
	
	
	   <?php include('header.php');?>
     

        <div class="container" id="main_container">
	
                 <div class="row">
                   <div class="col-sm-10">
                     <h1>vota<b>film</b>fest</h1>
                   </div>
                   <div class="col-sm-2">
                      <a href="<?php echo URL_CONCU; ?>" class="btn btn-secondary">Regresar al sitio</a>
                   </div>
                </div>
                  
                
              
                 <div id="div_errors"></div>
                  <?php
                   

                  echo '<div class="row">';
                      echo '<div class="col-sm-6">';
                            echo "Haz clic en el botón para descargar tu acuse de registro.";
                      echo '</div>';
                    echo '</div>';

                
                    echo '<div class="row">';

                      echo '<div class="col-sm-6 card">';
                            echo "Folio:".$folio;
                      echo '</div>';
                    echo '</div>';

                    echo '<div class="row">';
                    
                       echo '<div class="col-sm-6">';
                         echo '<form method="post" action="descargaracuse.php" target="_blank">
                                  <button type="submit" class="btn btn-primary btn-block">Descargar acuse</button>
                                  <input type="hidden" name="folio"  value="'.$folio.'">

                            </form>';
                      
                      echo '</div>';



                    echo '</div>';
                 
                    
                   

                 



                 ?>
	
	             

              
			
	       
			
			    
			
	</div> <!--- cierra  conteiner  -->
   <?php include('footer.php');?>
</body>
</html>
