<?php
session_start();

$categoria=$_POST['categoria'];
$primer_registro=0;




include('sqlconnector.php');
	


		
				echo "<h5>Sorteados</h5>";

          	$query= "SELECT * FROM ".BD_PARTICIPANTES." where categoria=".$categoria." AND sorteo is not null ORDER BY CAST(SUBSTRING(sorteo,2,2) as INT) DESC";


          	$indice=0;
          	$grupo_buffer="0";
			  $row = sqlsrv_query($conn,$query);
	          while($res=sqlsrv_fetch_array($row))
	          {

	          	$grupo=$res['sorteo'];

	          	$nombre=$res['nombre']." ".$res['paterno']." ".$res['materno'];
	          	$folio=$res['folio'];
	              
	            if($grupo_buffer!=$grupo){
	            	if($grupo_buffer!="0"){
	            		echo '</div>'; //cierre
	            	}
	              	echo '<div class="row alert alert-info" >';
	              	echo '<div class="col-sm-1">'.$res['sorteo'].' ';
	              	if($primer_registro<=0){
	              		echo '<a href="#" onclick="deshacersorteo(&quot;'.$res['sorteo'].'&quot;)">(x)</a>';
	              		$primer_registro++;
	              	}
	              	echo '</div>';
	            }
	          	
	          	
	          	
	          	
	          	
	          		echo' <div class="col"><p><b>'.$folio.'</b></p><p style="font-size:10px;">'.$nombre.'</p></div>';

	          	
	            //echo '<div class="col-sm-1">  ////'.$grupo_buffer.'-'.$grupo.'////   </div>';
	           

	          	

	            $grupo_buffer=$grupo;

	          				
	          
	          }

	          //echo "NADA";

          