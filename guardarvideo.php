<?php

	//echo "guardarparticipante.php";
	include('sqlconnector.php');

	$idusuario=$_POST["idusuario"];
	$video1=urlencode($_POST["video1"]);
	     



	    $query="UPDATE ".BD_PARTICIPANTES." SET video='".$video1."' where idusuario=".$idusuario." ;";

		  $row = sqlsrv_query($conn,$query);
          if($row)
          {
              
          	echo '<span class="badge badge-success">Guardado</span>';
          	
          }else{

          //	echo $query;
          	echo '<span class="badge badge-warning">Error</span>';
          	
		
           //die( print_r( sqlsrv_errors(), true));
           
          }

		//echo $query;

		//echo "     /".$correo_tutor."/    ";

		//echo "  //".$_POST["correo_tutor"]."//   ";



    

?>