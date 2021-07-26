<?php
include('sqlconnector.php');


for($i=100;$i<150;$i++){


		 $idusuario=$i;

	      $nombre=substr(md5(microtime()),rand(0,26),5);
	      $paterno=substr(md5(microtime()),rand(0,26),5);;
	      $materno=substr(md5(microtime()),rand(0,26),5);;
	     
	      $genero="M";
	      $fecha_nacimiento="2006-01-01";

	      $categoria=1;
	      $correo="aa@m.com";

	      $folio="CD-A-".$i;
	      
	      //$titulo=$_POST["titulo"];
	      //$sobrenombre=$_POST["sobrenombre"];
	     
	      

	    	      
	      $tel1="1234";
	      $tel2="1234";

		$alcaldia=1;
		$entidad=2;
		$domicilio="Casa 1";
		/*$resido_cdmx=$_POST["resido_cdmx"];
		$soyoriundo=$_POST["soyoriundo"];
		$soyoriginario=$_POST["soyoriginario"];*/
		$te_enteraste=2;
	    $distrito=0;
	      
	    $enlace="main";

		$query="INSERT INTO ".BD_PARTICIPANTES." (idusuario, nombre, paterno, materno, fecha_nacimiento,
	    genero, correo, tel1, tel2, categoria,
	    iddistrito, fecha_alta, fecha_modifica, alcaldia, entidad,
	    domicilio,te_enteraste, folio)

	    values(".$idusuario.",'".$nombre."', '".$paterno."', '".$materno."', '".$fecha_nacimiento."',
	    '".$genero."', '".$correo."', '".$tel1."', '".$tel2."', ".$categoria.",
	    ".$distrito.",'".date("Y-m-d h:i:sa")."','".date("Y-m-d h:i:sa")."',".$alcaldia.",'".$entidad."',
	    '".$domicilio."',".$te_enteraste.",'".$folio."' );";

		  $row = sqlsrv_query($conn,$query);
          if($row)
          {
              
          
          }else{

          	//echo $query;
          
		
            die( print_r( sqlsrv_errors(), true));
           
          }
}

?>