<?php

	include 'sqlconnector.php';
 //session_start();
 //$my_user=$_SESSION["usr"];
	define("UPLOAD_DIR", "uploads/");
 $idusuario=$_POST["idusuario"];
 $index=$_POST["index"];


 



    $query="SELECT A.*,B.fecha_nacimiento,B.fecha_alta as fecha_alta_usuario FROM ".BD_PARTICIPANTES." as A LEFT JOIN ".BD_USUARIOS." as B ON A.idusuario= B.idusuario WHERE A.idusuario =".$idusuario."";
  //  echo $query;
    $res=sqlsrv_query($conn,$query);
    
    if($row= sqlsrv_fetch_array($res)){

    	$fecha_nacimiento=$row["fecha_nacimiento"];
      $categoria=$row["categoria"];
        $fecha_alta=$row["fecha_alta_usuario"];

         $pais=$row["pais"];



       $doc1=$row["doc1"];
        $status_doc1=$row["status_doc1"];
        $observa_doc1=$row["observa_doc1"];

        $doc2=$row["doc2"];
        $status_doc2=$row["status_doc2"];
        $observa_doc2=$row["observa_doc2"];

        $doc3=$row["doc3"];
        $status_doc3=$row["status_doc3"];
        $observa_doc3=$row["observa_doc3"];

        $doc4=$row["doc4"];
        $status_doc4=$row["status_doc4"];
        $observa_doc4=$row["observa_doc4"];

        
        $doc5=$row["doc5"];
        $status_doc5=$row["status_doc5"];
        $observa_doc5=$row["observa_doc5"];

        $doc6=$row["doc6"];
        $status_doc6=$row["status_doc6"];
        $observa_doc6=$row["observa_doc6"];

        $doc7=$row["doc7"];
        $status_doc7=$row["status_doc7"];
        $observa_doc7=$row["observa_doc7"];

        $doc8=$row["doc8"];
        $status_doc8=$row["status_doc8"];
        $observa_doc8=$row["observa_doc8"];





    }

    /*if($ensayo&&$identificacion&&$manifestacion&&$cartacesion&&$formato){
        $completado=true;
        $mensaje='<div class="alert alert-success">
                <p>Tu registro fue exitoso. Tienes que esperar la validación de documentos para poder continuar con el concurso. Una vez validados verás tu número de folio.</p>
            </div>';
    }
    else{
        $completado=false;

        $mensaje= '<div class="alert alert-warning">
                <p>Para poder continuar con el concurso deberás adjuntar todos los documentos.</p>
            </div>';
    }*/

    $validado_disabled="";
    $validado_disabled2="";

    if($pais==117){
       
       if($categoria==1){
          if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
              $validado_disabled=" disabled";
              $validado_disabled2=' style="pointer-events: none;"';
              $validado="OK";
          }
        }///1

        if($categoria==2){
            if($status_doc1=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
               $validado_disabled=" disabled";
               $validado_disabled2=' style="pointer-events: none;"';
               $validado="OK";
           
            }

        }////2

    }else{   ////extranjero

        if($categoria==1){
          if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
            $validado_disabled=" disabled";
            $validado_disabled2=' style="pointer-events: none;"';
            $validado="OK";
          }
        }///1

        if($categoria==2){
            if($status_doc1=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
              $validado_disabled=" disabled";
              $validado_disabled2=' style="pointer-events: none;"';
              $validado="OK";
            
            }

        }////2
    }

    /*

    $fecha_nacimiento="2001-03-16";
    $fecha_inicio_concurso="2019-04-01";
    $fecha_fin_concurso="2019-04-30";
    $fecha_fin_año_concurso="2019-12-31";

    

    $años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
    $años_inicio=date_diff(date_create($fecha_nacimiento), date_create($fecha_inicio_concurso))->y;
    $años_fin=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_concurso))->y;
    $años_fin_año=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_año_concurso))->y;


    echo " / ".$fecha_nacimiento." / ";
    
    echo "<p>  edad hoy: ".$años_hoy."/ </p>";

    echo "<p>  edad al inicio del concurso: ".$años_inicio."/ </p>";
    echo "<p>  edad al fin del concurso: ".$años_fin."/ </p>";

   
    echo "<p>  edad al fin del año: ".$años_fin_año."/ </p>";



    if($años_inicio<=29&&$años_fin>=18){
    	echo "Califica. ";
    	
    	if($años_inicio<=29&&$años_fin<=29&&$años_inicio>=18) echo "Tendría la edad adecuada durante el concurso. ";
    	if($años_inicio<=29&&$años_fin>29) echo "Tendría la edad adecuada sólo al inicio. ";

    }

    if($años_fin_año>=18&&$años_fin_año<19){
    	echo "Sería mayor de edad este año, en algún momento, incluso después del concurso. ";
    }

    if($años_hoy<=29&&$años_hoy>=18){
    	echo "El día de hoy, tendría la edad adecuada. ";
    }

    */
   /*$tooltip0="Escanear en formato PDF la identificación de tu mamá, papá, tutor o tutora: credencial para votar vigente, licencia para conducir, cartilla del Servicio Militar Nacional, pasaporte, cédula profesional, matrícula consular o identificación oficial emitida por autoridad del país de origen o del país en que reside. Asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";
 
   $tooltip1="Escanear en formato PDF el comprobante de domicilio de la Ciudad de México no mayor a 3 meses al momento del registro. En el caso de que, debido a la movilidad estudiantil, el participante radique en otro estado, pero estudie en la Ciudad de México, deberá comprobar su domicilio con la credencial de estudiante de la institución. Asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.";

 
 $tooltip2="Llenar y firmar con tinta azul toda la información que se solicita en el formato. Para el caso de los menores de edad, deberá ser firmado por la madre, padre o tutor/a, para la participación del menor en todas las etapas del concurso. Escanearlo a color en formato PDF, asegurándose de que se ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.";
  $tooltip3="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a.";

   $tooltip4="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a.";

   $tooltip5="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4Mb. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a.";*/


/*$identificacion_64=base64_encode($identificacion);
$comprobante_64=base64_encode($comprobante);
$aceptacion_64=base64_encode($aceptacion);
$formato_64=base64_encode($formato); 
$manifestacion_64=base64_encode($manifestacion);


 $autorizacion_64=base64_encode($autorizacion);*/




    
    if($index==0){

         $doc1_64=base64_encode($doc1);

         $tooltip0="Escanear en formato PDF tu identificación: acta de nacimiento, credencial para votar vigente, licencia para conducir, cartilla del Servicio Militar Nacional, pasaporte, cédula profesional o matrícula consular. En caso de menores de edad, deberán adjuntar su credencial de la escuela, pasaporte o cualquier otra identificación. Asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";
    
    	echo '
                                     <div class="col-sm">';
                                        if($doc1){
                                            echo '<a href="getfilepdf.php?data='.$doc1_64.'" target="_blank" class="btn btn-primary">Mi identificación</a>';


                                            if($status_doc1==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc1==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc1.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar copia de una identificación de la o el autor del corto</div>
                                                <input type="file" id="file-select-0" class="form-control-file"  onchange="fnUpload('.$idusuario.',0)"  '.$validado_disabled.'>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="" data-toggle="tooltip" data-html="true" title="'.$tooltip0.'" class="color-tooltip">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                           

                                           

                                        </div>';
   	}
   	
  	

   	if($index==1){
        $doc2_64=base64_encode($doc2);
        $tooltip1="Copia de credencial para votar de padre, madre o tutor. En caso de no contar con credencial para votar, bastará presentar una carta de apoyo firmado por la madre, padre o tutor. Asegúrate que el archivo no sea mayor a 4MB";
   	
    	                   echo '   
                               <div class="col-sm">';
                                        if($doc2){
                                            echo '<a href="getfilepdf.php?data='.$doc2_64.'" target="_blank" class="btn btn-primary">Mi identificación tutor</a>';


                                            if($status_doc2==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc2==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc2.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar identificación tutor</div>
                                                <input type="file" id="file-select-1" class="form-control-file"  onchange="fnUpload('.$idusuario.',1)"  '.$validado_disabled.'>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip1.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>';
   	}

   	if($index==2){
         $doc3_64=base64_encode($doc3);
        $tooltip2="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a. <i>Descarga el formato <b>1</b> de la columna de la izquierda.";
    	echo '
    			                   <div class="col-sm">';
                                        if($doc3){
                                            echo '<a href="getfilepdf.php?data='.$doc3_64.'" target="_blank" class="btn btn-primary">Mi Carta de cesión de derechos (1)</a>';

                                            if($status_doc3==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc3==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc3.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar Carta de cesión de derechos</div>
                                                <input type="file" id="file-select-2" class="form-control-file"  onchange="fnUpload('.$idusuario.',2)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip2.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
    			
    		
    		  ';
    }

    if($index==3){
        $doc4_64=base64_encode($doc4);
         $tooltip3="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a. <i>Descarga el formato <b>2</b> de la columna de la izquierda.";

   	
    	echo '
               <div class="col-sm">';
                                        if($doc4){
                                            echo '<a href="getfilepdf.php?data='.$doc4_64.'" target="_blank" class="btn btn-primary">Mi Carta bajo protesta ...</a>';

                                            if($status_doc4==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc4==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc4.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar Carta bajo protesta ... (2)</div>
                                                <input type="file" id="file-select-3" class="form-control-file"  onchange="fnUpload('.$idusuario.',3)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip3.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>    			
    		
    		  ';
    }

     if($index==4){

        $doc5_64=base64_encode($doc5);
          $tooltip4="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";

    
        echo '
                   <div class="col-sm">';
                                        if($doc5){
                                            echo '<a href="getfilepdf.php?data='.$doc5_64.'" target="_blank" class="btn btn-primary">Mi formato de declaración...</a>';
                                            if($status_doc5==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc5==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc5.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar formato de declaración de que la obra es original e inédita, así como la carta de cesión de derechos</div>
                                                <input type="file" id="file-select-4" class="form-control-file"  onchange="fnUpload('.$idusuario.',4)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip4.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>                
            
              ';
    }

     if($index==5){

       $doc6_64=base64_encode($doc6);
         $tooltip5="Asegúrate que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";

    
        echo '
                   <div class="col-sm">';
                                        if($doc6){
                                            echo '<a href="getfilepdf.php?data='.$doc6_64.'" target="_blank" class="btn btn-primary">Mi copia de matrícula consular ...</a>';
                                            if($status_doc6==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc6==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc6.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar copia de matrícula consular (sólo si vives fuera de México)</div>
                                                <input type="file" id="file-select-5" class="form-control-file"  onchange="fnUpload('.$idusuario.',5)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip5.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                                      
            
              ';
    }

     if($index==6){

        $doc7_64=base64_encode($doc7);
        $tooltip6="Escanea en formato PDF, aseguúrate de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";

    
        echo '
                   <div class="col-sm">';
                                        if($doc7){
                                            echo '<a href="getfilepdf.php?data='.$doc7_64.'" target="_blank" class="btn btn-primary">Mi justificación</a>';
                                            if($status_doc7==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc7==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc7.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar formato de justificación. (2)</div>
                                                <input type="file" id="file-select-6" class="form-control-file"  onchange="fnUpload('.$idusuario.',6)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip6.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                                      
            
              ';
    }


    if($index==7){

        $doc8_64=base64_encode($doc8);
        $tooltip7="Escanea en formato PDF, asegúrate de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.";

    
        echo '
                   <div class="col-sm">';
                                        if($doc8){
                                            echo '<a href="getfilepdf.php?data='.$doc8_64.'" target="_blank" class="btn btn-primary">Mi autorización...</a>';
                                            if($status_doc8==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_doc8==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_doc8.'">
                                                  !
                                                </span>';
                                            }
                                        }
                                        else{
                                            echo '-';
                                        }

                                echo   '</div>
                                        <div class="col-sm">
                                                                                                                       
                                            <div class="upload-btn-wrapper" '.$validado_disabled2.'>
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar formato autorización a participar en caso de que la persona participante tenga la menoría de edad.(6)</div>
                                                <input type="file" id="file-select-7" class="form-control-file"  onchange="fnUpload('.$idusuario.',7)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip7.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                                      
            
              ';
    }

    

    


   	

 ?>