<?php

 $filename = "testexcel.xls";

  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel; charset=utf-8");
  echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	





//echo $sql;


 echo '<table>';
echo "<th colspan=12>";
echo "<font style='font-size:14px;font-weight:bold;'>REPORTE DE PERSONAS VALIDADAS AL CONCURSO DE ensayo <br></font><br>";
echo "</th>";
echo"<br>"; 

echo '<tr>
                
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    
                   
                  
                   
        </tr>';


    for($i=0;$i<15;$i++){
	  
	  
      echo '<tr>
                
                <td>'.$i.'</td>
                <td>'.(($i*99999)/4)'</td>
                <td>'.rand(1000,99999).'</td>';
               


          
          

          echo '<td>x</td>

          </tr>';




         

	  
	  
	  
  }
   echo '</table>';
?>