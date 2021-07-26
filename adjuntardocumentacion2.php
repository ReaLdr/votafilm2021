<?php

	include 'sqlconnector.php';
 //session_start();
 //$my_user=$_SESSION["usr"];
 $idusuario=$_SESSION["idusuario"];
 define("UPLOAD_DIR", "uploads/");


 

 if($registrado){

    $query="SELECT A.*,B.fecha_nacimiento,B.fecha_alta as fecha_alta_usuario FROM ".BD_PARTICIPANTES." as A LEFT JOIN ".BD_USUARIOS." as B ON A.idusuario= B.idusuario WHERE A.idusuario =".$idusuario."";
  //  echo $query;
    $res=sqlsrv_query($conn,$query);
    
    if($row= sqlsrv_fetch_array($res)){

    	$fecha_nacimiento=$row["fecha_nacimiento"];
        $fecha_alta=$row["fecha_alta_usuario"];


    	/*$debate=$row["debate"];
    	$status_debate=$row["status_debate"];
    	$observa_debate=$row["observa_debate"];*/
        $identificacion=$row["identificacion"];
        $status_identifica=$row["status_identifica"];
        $observa_identifica=$row["observa_identifica"];

    	$comprobante=$row["comprobante"];
    	$status_comprobante=$row["status_comprobante"];
    	$observa_comprobante=$row["observa_comprobante"];

        $aceptacion=$row["aceptacion"];
        $status_aceptacion=$row["status_aceptacion"];
        $observa_aceptacion=$row["observa_aceptacion"];

        $formato=$row["formato"];
        $status_formato=$row["status_formato"];
        $observa_formato=$row["observa_formato"];

    	
    	$manifestacion=$row["manifestacion"];
    	$status_manifest=$row["status_manifest"];
    	$observa_manifest=$row["observa_manifest"];

        $autorizacion=$row["autorizacion"];
        $status_autorizacion=$row["status_autorizacion"];
        $observa_autorizacion=$row["observa_autorizacion"];

    	

    	




    }

     if($identificacion&&$comprobante&&$aceptacion&&$formato&&$manifestacion&&$autorizacion){
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
    }

    $validado_disabled="";
    $validado_disabled2="";

    if($status_identifica=='1'&&$status_comprobante=='1'&&$status_aceptacion=='1'&&$status_formato=='1'&&$status_manifest=='1'&&$status_autorizacion=='1'){
        $validado_disabled=" disabled";
        $validado_disabled2=' style="pointer-events: none;"';
        $validado="OK";
     }



     /*

     if($status_boceto=='2'&&$status_identifica=='2'&&$status_declara=='2'&&$status_manifest=='2'&&$status_carta=='2'&&$status_formato=='2'){
        $validado_disabled_incorrecto=" disabled";
        $validado="Incorrecto";

     }*/
    

    $edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_alta))->y;
    //echo " /".$edad."/ ";


    if(!($identificacion||$comprobante||$aceptacion||$formato||$manifestacion||$autorizacion)){
                    echo'
                          <div class="row" id="anim">
                          
                            <div class="col-sm-6">
                                <div class="bg-info text-white anim1">
                                  <i class="fas fa-long-arrow-alt-down"></i> Descarga los formatos aquí   
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="bg-info text-white anim2" style="opacity:0;">
                                   Adjunta tus documentos aquí  <i class="fas fa-long-arrow-alt-down"></i> 
                                </div>
                            </div>
                            
                          </div>';
                        }

    

   
 
    




   
        echo '<div class="row">
                <div class="col-sm-6">
                   <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Descargas</h4>';
                            if($edad>=18){
                                echo '<p>Descarga los siguientes formatos y llénalos con tinta azul.</p>';
                                 echo "<hr>";
                              
                               echo ' <div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/aceptacion.docx').'" target="_blank">Aceptación de los términos establecidos en la convocatoria.</a></div>
                                      </div>';
                               
                                echo "<hr>";
                                
                                echo ' <div class="row">
                                            <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/formato.docx').'" target="_blank">Formato de protección de datos personales.</a></div>
                                          </div>';
                                echo "<hr>";

                                echo '<div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/manifestacion.docx').'" target="_blank">Manifestación bajo protesta de decir verdad que toda la información proporcionada es cierta.</a></div>
                                      </div>';
                                echo "<hr>";

                                echo '<div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/autorizacion.docx').'" target="_blank">Autorización del uso de imagen.</a></div>
                                      </div>';



                            }else{
                                echo '<p>Menor de edad</p>';
                               echo '<p>Descarga los siguientes formatos y llénalos con tinta azul.</p>';
                                 echo "<hr>";
                              
                               echo ' <div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/aceptacion.docx').'" target="_blank">Aceptación de los términos establecidos en la convocatoria.</a></div>
                                      </div>';
                               
                                echo "<hr>";
                                
                                echo ' <div class="row">
                                            <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/formato.docx').'" target="_blank">Formato de protección de datos personales.</a></div>
                                          </div>';
                                echo "<hr>";

                                echo '<div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/manifestacion.docx').'" target="_blank">Manifestación bajo protesta de decir verdad que toda la información proporcionada es cierta.</a></div>
                                      </div>';
                                echo "<hr>";

                                echo '<div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/autorizacion.docx').'" target="_blank">Autorización del uso de imagen.</a></div>
                                      </div>';


                            }
                            
                        
                    echo '</div>
                   </div>
                </div>

                <div class="col-sm-6">
                
                   <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Adjuntar documentación</h4>
                            <div id="mensajeadjuntos">'.$mensaje.'</div>';
                            $debate_64=base64_encode($debate);

                           /*
                            echo '<div class="row">
                                    <div class="col-sm">
                                        Mis archivos
                                    </div>
                                    <div class="col-sm">
                                    </div>
                                    <div class="col-sm-1">
                                    </div>
                                </div>';
                            */
                            echo '<hr>';


                           
                           
                            echo '<p class="texto-pequeño">Identificación oficial</p>';
                        ////////////////////////////////////////////// 0
                                $identificacion_64=base64_encode($identificacion);
                                $tooltip0="Escanear en formato PDF la identificación de tu mamá, papá, tutor o tutora: credencial para votar vigente, licencia para conducir, cartilla del Servicio Militar Nacional, pasaporte, cédula profesional, matrícula consular o identificación oficial emitida por autoridad del país de origen o del país en que reside. Asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";
                                echo '<div class="row" id="row-0">
                                       
                                        <div class="col-sm">';
                                        if($identificacion){
                                            echo '<a href="getfilepdf.php?data='.$identificacion_64.'" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Mi documento</a>';


                                            if($status_identifica==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_identifica==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_identifica.'">
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar documento</div>
                                                <input type="file" id="file-select-0" class="form-control-file"  onchange="fnUpload('.$idusuario.',0)"  '.$validado_disabled.'>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="" data-toggle="tooltip" data-html="true" title="'.$tooltip0.'" class="color-tooltip">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                           

                                           

                                        </div>
                                        
                                    
                                      </div>';///row0

                        ////////////////////////////////////////////// 0
                                echo '<hr>';
                                echo '<p class="texto-pequeño">Comprobante de domicilio</p>';
                         ////////////////////////////////////////////// 1
                                $comprobante_64=base64_encode($comprobante);
                                $tooltip1="Escanear en formato PDF el comprobante de domicilio de la Ciudad de México no mayor a 3 meses al momento del registro. En el caso de que, debido a la movilidad estudiantil, el participante radique en otro estado, pero estudie en la Ciudad de México, deberá comprobar su domicilio con la credencial de estudiante de la institución. Asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.";
                                echo '<div class="row" id="row-1">
                                       
                                        <div class="col-sm">
                                        ';
                                        if($comprobante){
                                            echo '<a href="getfilepdf.php?data='.$comprobante_64.'" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Mi documento</a>';


                                            if($status_comprobante==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_comprobante==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_comprobante.'">
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar documento</div>
                                                <input type="file" id="file-select-1" class="form-control-file"  onchange="fnUpload('.$idusuario.',1)"  '.$validado_disabled.'>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip1.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>';///row1

                        ////////////////////////////////////////////// 1
                                echo '<hr>';
                                echo '<p class="texto-pequeño">Aceptación de los términos establecidos en la convocatoria.</p>';
                        ///////////////////////////////////////////// 2
                                      $aceptacion_64=base64_encode($aceptacion);
                                      $tooltip2="Llenar y firmar con tinta azul toda la información que se solicita en el formato. Para el caso de los menores de edad, deberá ser firmado por la madre, padre o tutor/a, para la participación del menor en todas las etapas del concurso. Escanearlo a color en formato PDF, asegurándose de que se ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.";
                                echo '<div class="row" id="row-2">
                                       
                                        <div class="col-sm">';
                                        if($aceptacion){
                                            echo '<a href="getfilepdf.php?data='.$aceptacion_64.'" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Mi documento</a>';

                                            if($status_aceptacion==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_aceptacion==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_aceptacion.'">
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar documento</div>
                                                <input type="file" id="file-select-2" class="form-control-file"  onchange="fnUpload('.$idusuario.',2)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip2.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>';
                        ///////////////////////////////////////////// 2
                                 echo '<hr>';

                                  echo '<p class="texto-pequeño">Formato de protección de datos personales</p>';


                        ///////////////////////////////////////////// 3
                                    $formato_64=base64_encode($formato);
                                    $tooltip3="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a.";
                                echo '<div class="row" id="row-3">
                                       
                                        <div class="col-sm">';
                                        if($formato){
                                            echo '<a href="getfilepdf.php?data='.$formato_64.'" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Mi documento</a>';

                                            if($status_formato==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_formato==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_formato.'">
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar documento</div>
                                                <input type="file" id="file-select-3" class="form-control-file"  onchange="fnUpload('.$idusuario.',3)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip3.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>';
                        ///////////////////////////////////////////// 3

                         echo '<hr>';
                        echo '<p class="texto-pequeño">Manifestación bajo protesta de decir verdad que toda la información proporcionada es cierta</p>';
                      

                        ///////////////////////////////////////////// 4
                                    $manifestacion_64=base64_encode($manifestacion);
                                      $tooltip4="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a.";
                                echo '<div class="row" id="row-4">
                                       
                                        <div class="col-sm">';
                                        if($manifestacion){
                                            echo '<a href="getfilepdf.php?data='.$manifestacion_64.'" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Mi documento</a>';
                                            if($status_manifest==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_manifest==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_manifest.'">
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar documento</div>
                                                <input type="file" id="file-select-4" class="form-control-file"  onchange="fnUpload('.$idusuario.',4)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip4.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>'; ///row3

                        ///////////////////////////////////////////// 4

                          echo '<hr>';
                           echo '<p class="texto-pequeño">Autorización del uso de imagen</p>';
                      

                        ///////////////////////////////////////////// 5
                                    $autorizacion_64=base64_encode($autorizacion);
                                      $tooltip5="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4Mb. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a.";
                                echo '<div class="row" id="row-5">
                                       
                                        <div class="col-sm">';
                                        if($autorizacion){
                                            echo '<a href="getfilepdf.php?data='.$autorizacion_64.'" target="_blank" class="btn btn-primary"><i class="fas fa-file-alt"></i> Mi documento</a>';
                                            if($status_autorizacion==1){
                                                echo '<span class="badge badge-success">OK</span>';
                                            }
                                            if($status_autorizacion==2){
                                                echo '
                                                <span class="badge badge-warning"data-toggle="tooltip" data-placement="top" title="'.$observa_autorizacion.'">
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar documento</div>
                                                <input type="file" id="file-select-5" class="form-control-file"  onchange="fnUpload('.$idusuario.',5)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip5.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>'; ///row3

                        ///////////////////////////////////////////// 5
                               

                        

                                    ////card
                echo '</div>
                   </div>
                </div>
                

                
            
              </div>';///row principal
  

    echo '<hr>';




  

   

    



   	echo '<div id="errormsg"></div>';

   
  }else{
  	echo "No resgistrado";
  }

 ?>