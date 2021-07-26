<?php
session_start();

$cat=$_POST['categoria'];
//$fol=$_POST['folio'];

 $arr = array('total' => 0, 'folio1' => '', 'folio2' => '', 'folio3' => '', 'mensaje' => '');

include('sqlconnector.php');


          //$query= "SELECT * FROM ".BD_PARTICIPANTES." where categoria=".$cat." and folio='".$fol."' and extranjero=0 and sorteo is null";

           $query= "SELECT count(iddebate) as total FROM ".BD_PARTICIPANTES." where categoria=".$cat." and folio is not null and extranjero=0 and sorteo is null";


          	
			  $row = sqlsrv_query($conn,$query);
	          while($res=sqlsrv_fetch_array($row))
	          {

	          	$total=$res['total'];
	              
	            
	          }

	          //$arr = array('total' => $total, 'folio1' => '', 'folio2' => '', 'mensaje' => '');
	          $folios= array();

	          if($total>0){

	          	 if($total==3){


		          	$query= "SELECT top 3 folio FROM ".BD_PARTICIPANTES." where categoria=".$cat." and folio is not null and extranjero=0 and sorteo is null ORDER BY NEWID()";


	          	
					  $row = sqlsrv_query($conn,$query);
			          while($res=sqlsrv_fetch_array($row))
			          {
			          	$folios[]=$res['folio'];
			          }

			          $arr = array('total' => $total, 'folio1' => $folios[0], 'folio2' => $folios[1], 'folio3' => $folios[2], 'mensaje' => '');
		          	

		          	
		          }else{

		          	$query= "SELECT top 2 folio FROM ".BD_PARTICIPANTES." where categoria=".$cat." and folio is not null and extranjero=0 and sorteo is null ORDER BY NEWID()";


	          	
					  $row = sqlsrv_query($conn,$query);
			          while($res=sqlsrv_fetch_array($row))
			          {
			          	$folios[]=$res['folio'];
			          }


			           $arr = array('total' => $total, 'folio1' => $folios[0], 'folio2' => $folios[1], 'folio3' =>'0', 'mensaje' => '');




		          	
		          }

	          }


	         

	         

	          echo json_encode($arr);

	          

	

?>
		
	

	          

	        

          