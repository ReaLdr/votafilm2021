<?php
session_start();

$cat=$_POST['categoria'];
$fol=$_POST['folio'];

$nombre="";
$folio="";

include('sqlconnector.php');


          $query= "SELECT * FROM ".BD_PARTICIPANTES." where categoria=".$cat." and folio='".$fol."' and extranjero=0 and sorteo is null";


          	
			  $row = sqlsrv_query($conn,$query);
	          while($res=sqlsrv_fetch_array($row))
	          {

	          	$nombre=$res['nombre']." ".$res['paterno']." ".$res['materno'];
	          	$folio=$res['folio'];
	              
	            /*if($indice%2==0){
	              	echo '<div class="row alert alert-warning" >';
	            }
	          	
	          	
	          	
	          	
	          	
	          		echo' <div class="col">'.$nombre.' - '.$folio.
	          				'</div>';

	          	if($indice%2==0){
	              	echo '<div class="col-sm-1">VS</div>';
	            }

	          	if($indice%2!=0){
	              	echo $indice.'</div>';
	            }

	            $indice++;*/

	          				
	          
	          }


	          if($folio!=""){
	          	$arr = array('nombre' => $nombre, 'folio' => $folio, 'mensaje' => '');
				echo json_encode($arr);

	          	
	          }else{
	          	$arr = array('nombre' => '', 'folio' => '0', 'mensaje' => 'Folio no existe o ya está sorteado');
				echo json_encode($arr);
	          }

	          

	

?>
		
	

	          

	        

          