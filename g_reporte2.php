<?php

 $filename = "solicitudes_votafilmfest".date('Ymd_h-i-s').".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel; charset=utf-8");
  echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

include('sqlconnector.php');
include('rutasitio.php');
include('cat_alcaldia.php');

 define("UPLOAD_DIR", "uploads/");

	error_reporting(0);


$sql="select * from ".BD_PARTICIPANTES." order by categoria,folio ASC";


//echo $sql;


 echo '<table>';
echo "<th colspan=20>";
echo "<font style='font-size:14px;font-weight:bold;'>SOLICITUDES DE REGISTROS AL VOTAFILMFEST 2021<br></font><br>";
echo "</th>";
echo"<br>";

echo '<tr>

                   <th>Folio de registro</th>
                    <th>Nombre(s)</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>


                    <th>Teléfono de contacto</th>
                    <th>Correo electrónico</th>
                    <th>Genero</th>
                    <th>Edad</th>
                    <th>Categoría</th>
                    <th>País</th>
                    <th>Entidad</th>
                    <th>Alcaldía</th>
                    <th>Liga del video</th>




					<th>Identificación</th>
					<th>Observaciones </th>

					<th>Identificación tutor</th>
					<th>Observaciones </th>




					<th>Carta de cesión de derechos</th>
					<th>Observaciones </th>




					<th>Carta bajo protesta de decir verdad que la obra es orginal e inédita</th>
					<th>Observaciones</th>





				  	<th>Observaciones Generales</th>



        </tr>';

        $fecha_inicio_concurso="2021-07-27";
        //$fecha_inicio_concurso="2021-08-10";//BUENA


$row = sqlsrv_query($conn,$sql);
  while($res = sqlsrv_fetch_array($row))
  {


      echo '<tr>';

	     if($res['folio'] <> ''){
		echo'<td>'.$res['folio'].'</td>';
		 }else{echo'<td>--</td>';}


         echo'  <td>'.$res['nombre'].'</td>
                <td>'.$res['paterno'].'</td>
                <td>'.$res['materno'].'</td>

                <td>\''.$res['tel1'].'</td>
                <td>'.$res['correo'].'</td>

	  			      <td>'.$res['genero'].'</td>
                <td>'.date_diff(date_create($res['fecha_nacimiento']), date_create($fecha_inicio_concurso))->y.'</td>
                <td>'.$res['categoria'].'</td>
                <td>'.$paises[$res['pais']].'</td>
                <td>'.$res['entidad'].'</td>
                <td>'.$cat_alcaldia[$res['alcaldia']].'</td>
                <td>'.urldecode($res['video']).'</td>';



//////////1
				   if($res['doc1'] <> ''){
					echo'<td><a class="btn-icon" href="'.URL_CONCU.UPLOAD_DIR.$res['doc1'].'" target="_blank" >ver/doc1</i></a></td>';
				   }else{echo'<td>--</td>';}

	  				echo'<td>'.$res['observa_doc1'].'</td>';
//////////2

	  				 if($res['doc2'] <> ''){
					echo'<td><a class="btn-icon" href="'.URL_CONCU.UPLOAD_DIR.$res['doc2'].'" target="_blank" >ver/doc2</i></a></td>';
				   }else{echo'<td>--</td>';}

	  				echo'<td>'.$res['observa_doc2'].'</td>';

//////////3

	  				 if($res['doc3'] <> ''){
					echo'<td><a class="btn-icon" href="'.URL_CONCU.UPLOAD_DIR.$res['doc3'].'" target="_blank" >ver/doc3</i></a></td>';
				   }else{echo'<td>--</td>';}

	  				echo'<td>'.$res['observa_doc3'].'</td>';
//////////4

	  				 if($res['doc4'] <> ''){
					echo'<td><a class="btn-icon" href="'.URL_CONCU.UPLOAD_DIR.$res['doc4'].'" target="_blank" >ver/doc4</i></a></td>';
				   }else{echo'<td>--</td>';}

	  				echo'<td>'.$res['observa_doc4'].'</td>';

	  			echo'<td>'.$res['observa_requisitos'].'</td>';

	  			/*$dist=$res['iddistrito'];
	  			switch ($dist) {
	  				case 0:
	  					$registro_web_dist="Web";
	  					break;
	  				case 40:
	  					$registro_web_dist="Oficinas centrales";
	  					break;

	  				default:
	  					$registro_web_dist="Distrito ".$dist;
	  			}


	  			echo'<td>'.$registro_web_dist.'</td>';*/

          echo '</tr>';




  }
   echo '</table>';
?>
