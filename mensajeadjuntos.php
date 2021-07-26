<?php

	include 'sqlconnector.php';
 //session_start();
 //$my_user=$_SESSION["usr"];
	define("UPLOAD_DIR", "uploads/");
 $idusuario=$_POST["idusuario"];
 //$index=$_POST["index"];


 



    $query="SELECT * FROM ".BD_PARTICIPANTES." WHERE idusuario =".$idusuario."";
  //  echo $query;
    $res=sqlsrv_query($conn,$query);
    
    if($row= sqlsrv_fetch_array($res)){

    	

    	
    	

    	$doc1=$row["doc1"];

        $doc2=$row["doc2"];
        $doc3=$row["doc3"];
        $doc4=$row["doc4"];
    	

    	
    	

    	$doc5=$row["doc5"];
        $doc6=$row["doc6"];
          $doc7=$row["doc7"];
            $doc8=$row["doc8"];


         $fecha_nacimiento=$row["fecha_nacimiento"];
         $categoria=$row["categoria"];
         $pais=$row["pais"];


        $fecha_fin_concurso="2019-09-30";

        //$status_requisitos=$row['status_requisitos'];
  //$años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
       // $edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_concurso))->y;
    	

    	
    	
    	
    	




    }

    $texto_ok='<div class="alert alert-success">
                <p>Tu registro fue exitoso, tienes que esperar la validación de tus documentos. Vía correo electrónico te informaremos si es necesario que corrijas algún documento, y si todo está correcto te enviaremos a tu correo electrónico tu número de folio de participante</p>
            </div>';


    $texto_nop='<div class="alert alert-warning">
                          <p>Para poder continuar deberás adjuntar todos los documentos.</p>
                      </div>';

     if($pais==117){
       
       if($categoria==1){
          if($doc1&&$doc2&&$doc3&&$doc4){
            $completado=true;
             $mensaje= $texto_ok;
          }else{
            $completado=false;
             $mensaje= $texto_nop;
          }
        }///1

        if($categoria==2){
            if($doc1&&$doc3&&$doc4){
              $completado=true;
               $mensaje= $texto_ok;
            }else{
              $completado=false;
              $mensaje= $texto_nop;
            }

        }////2

    }else{   ////extranjero

        if($categoria==1){
          if($doc1&&$doc2&&$doc3&&$doc4){
            $completado=true;
             $mensaje= $texto_ok;
          }else{
            $completado=false;
             $mensaje= $texto_nop;
          }
        }///1

        if($categoria==2){
            if($doc1&&$doc3&&$doc4){
              $completado=true;
              $mensaje= $texto_ok;
            }else{
              $completado=false;
              $mensaje= $texto_nop;
            }

        }////2
    }


    if($completado){
        $query= "UPDATE ".BD_PARTICIPANTES." SET status_requisitos=1 where idusuario=".$idusuario."";//observa_manifest

        $row=sqlsrv_query($conn,$query);

      if($row){
        //echo ' <a href="'.UPLOAD_DIR .$ruta_docto_.'" target="_blank" class="btn-icon"><i class="fas fa-file-signature"></i><i class="far fa-thumbs-up"></i></a>';//

              echo "<span class='badge badge-success' <b>Documentación completada</b></span>";
                      
                   

      }else{
              echo " <b>Eror al actualizar el status</b>";
      }




    }

   
   	

 ?>