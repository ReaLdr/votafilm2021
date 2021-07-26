<?php

 $filename = "registro_votafilmfest".date('Ymd_h-i-s').".xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel; charset=utf-8");
  echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	
include('sqlconnector.php');
include('cat_alcaldia.php');
	error_reporting(0);


$sql="select * from ".BD_PARTICIPANTES." WHERE folio is not null order by folio ASC ";


//echo $sql;


 echo '<table>';
echo "<th colspan=12>";

echo "<font style='font-size:14px;font-weight:bold;'>VOTAFILMFEST 2020 - REPORTE DE PERSONAS VALIDADAS<br></font><br>";
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
					        
                   <th>Usuario que validó</th>
                   
                  
                   
        </tr>';

 $fecha_inicio_concurso="2020-07-21";
  //$años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;



$row = sqlsrv_query($conn,$sql);
  while($res = sqlsrv_fetch_array($row))
  {
	  
	  
      echo '<tr>
                
                <td>'.$res['folio'].'</td>
                <td>'.$res['nombre'].'</td>
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


          $usuario_validador= array(1 => "admin1",2 => "admin2",3 =>"central3", 5 =>"-" );

         
          $usuario_que_valido=$usuario_validador[$res['validador']];

        
          

          echo '<td>'.$usuario_que_valido.'</td>

          </tr>';




         

	  
	  
	  
  }
   echo '</table>';
?>