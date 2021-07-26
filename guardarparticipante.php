<?php

	//echo "guardarparticipante.php";
	include('sqlconnector.php');

	$idusuario=$_POST["idusuario"];


	      $nombre=$_POST["nombre"];
	      $paterno=$_POST["paterno"];
	      $materno=$_POST["materno"];
	     // $area=$_POST["area"];
	      $genero=$_POST["genero"];
	      $fecha_nacimiento=$_POST["fecha_nacimiento"];

	      $categoria=$_POST["categoria"];
	      $correo=$_POST["correo"];
	      
	      //$titulo=$_POST["titulo"];
	      //$sobrenombre=$_POST["sobrenombre"];
	     
	      

	    	      
	      $tel1=$_POST["tel1"];
	     

	    $pais=$_POST["pais"];

		$alcaldia=$_POST["alcaldia"];
		$entidad=$_POST["entidad"];

		$video=urlencode($_POST["video0"]);
		//$domicilio=$_POST["domicilio"];
		/*$resido_cdmx=$_POST["resido_cdmx"];
		$soyoriundo=$_POST["soyoriundo"];
		$soyoriginario=$_POST["soyoriginario"];*/
		//$te_enteraste=$_POST["te_enteraste"];
		//echo " /".$te_enteraste."/ ";
	    //$distrito=$_POST["distrito"];

	    /*$extranjero=$_POST["extranjero"];
	    if($extranjero==1||$extranjero=="1"){
	    	
	    	$alcaldia=0;

	    }*/
	      
	    $enlace="main";


	    $query="INSERT INTO ".BD_PARTICIPANTES." (idusuario, nombre, paterno, materno, fecha_nacimiento,
	    genero, correo, tel1, categoria,
	    fecha_alta, fecha_modifica, pais, alcaldia, entidad,video,status_requisitos  ) 

	    values(".$idusuario.",'".$nombre."', '".$paterno."', '".$materno."', '".$fecha_nacimiento."',
	    '".$genero."', '".$correo."', '".$tel1."', ".$categoria.",
	    '".date("Y-m-d h:i:sa")."','".date("Y-m-d h:i:sa")."',".$pais.",".$alcaldia.",'".$entidad."','".$video."',0 );";

		  $row = sqlsrv_query($conn,$query);
          if($row)
          {
              
          	echo '<div class="alert alert-success" >Datos guardados con éxito</div>';
          	echo '<a href="'.$enlace.'.php" class="btn btn-primary">Haz clic aquí para continuar</a>';
          }else{

          	//echo $query;
          	echo '<div class="alert alert-warning" >Hubo un error al guardar los datos. Intente de nuevo más tarde.</div>';
          	 echo '<a href="'.$enlace.'.php" class="btn btn-primary">Haz clic aquí para continuar</a>';
		
            die( print_r( sqlsrv_errors(), true));
           
          }

		//echo $query;

		//echo "     /".$correo_tutor."/    ";

		//echo "  //".$_POST["correo_tutor"]."//   ";



    

?>