<?php

	include 'sqlconnector.php';
  //include('cat_alcaldia.php');
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
      $categoria=$row["categoria"];
        $fecha_alta=$row["fecha_alta_usuario"];


    	/*$debate=$row["debate"];
    	$status_debate=$row["status_debate"];
    	$observa_debate=$row["observa_debate"];*/
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
/*
    	
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
*/

        $fecha_nacimiento=$row["fecha_nacimiento"];

        $status_requisitos=$row['status_requisitos'];


        //$fecha_fin_concurso="2019-09-30";
  //$años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
        $edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_alta))->y;

    	

    	




    }
    

      $status_label=array("Por completar documentación","Documentación completa / en revisión","Revisión / Error en documentos","Validado / Folio asignado","4?","???");



      $texto_ok='<div class="alert alert-success">
                <span class="badge badge-dark mb-3">Estatus: <b>'. $status_label[$status_requisitos].'</b></span>
                <p>Tu registro fue exitoso, tienes que esperar la validación de tus documentos. Vía correo electrónico te informaremos si es necesario que corrijas algún documento, y si todo está correcto te enviaremos a tu correo electrónico tu número de folio de participante.</p>
            </div>';


    $texto_nop='<div class="alert alert-warning">
                          <span class="badge badge-dark mb-3">Estatus:  <b>'. $status_label[$status_requisitos].' </b></span>
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




    

   

     
      
    

       


        



      //echo "consulta: ".$query;
      

    $validado_disabled="";
    $validado_disabled2="";

    /*

    if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'&&$status_doc5=='1'&&$status_doc6=='1' &&$status_doc7=='1'){
        
        if($edad>=18){

          $validado_disabled=" disabled";
          $validado_disabled2=' style="pointer-events: none;"';
          $validado="OK";

        }else{

            if($status_doc8=='1'){
                 $validado_disabled=" disabled";
                 $validado_disabled2=' style="pointer-events: none;"';
                 $validado="OK";

            }
        }
        

     }
     */
      $texto_validado='<div class="alert alert-success">
                <span class="badge badge-dark mb-3">Estatus: <b>'. $status_label[$status_requisitos].'</b></span>
                <p>Tu registro fue exitoso. Tus documentos validados. Descarga el acuse de registro desde el enlace enviado a tu correo o en esta página.</p>
            </div>';
      $texto_error='<div class="alert alert-warning">
                <span class="badge badge-dark mb-3">Estatus: <b>'. $status_label[$status_requisitos].'</b></span>
                <p>Corrige los documentos, tal como se describe en las observaciones enviadas por correo.</p>
            </div>';

     if($pais==117){
       
       if($categoria==1){
          if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
              $validado_disabled=" disabled";
              $validado_disabled2=' style="pointer-events: none;"';
              $validado="OK";
              $mensaje=$texto_validado;
          }
        }///1

        if($categoria==2){
            if($status_doc1=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
               $validado_disabled=" disabled";
               $validado_disabled2=' style="pointer-events: none;"';
               $validado="OK";
                 $mensaje=$texto_validado;
           
            }

        }////2

    }else{   ////extranjero

        if($categoria==1){
          if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
            $validado_disabled=" disabled";
            $validado_disabled2=' style="pointer-events: none;"';
            $validado="OK";
              $mensaje=$texto_validado;
          }
        }///1

        if($categoria==2){
            if($status_doc1=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
              $validado_disabled=" disabled";
              $validado_disabled2=' style="pointer-events: none;"';
              $validado="OK";
                $mensaje=$texto_validado;
            
            }

        }////2
    }

    if($status_requisitos==2){

       $mensaje=$texto_error;

    }



     /*

     if($status_boceto=='2'&&$status_doc1=='2'&&$status_declara=='2'&&$status_manifest=='2'&&$status_carta=='2'&&$status_doc4=='2'){
        $validado_disabled_incorrecto=" disabled";
        $validado="Incorrecto";

     }*/
    

    //$edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_alta))->y;
    //echo " /".$edad."/ ";


//echo " - ".$doc1." - ".$doc2." - ".$doc3." - ".$doc4;
/////////////////////////Actualizar video
     
     echo'<div class="m-2 p-3 border border-light">
          <h3>Enlace del video</h3>
           <label  class="control-label col-sm-8" for="nombre" style="color:#888;">Copia el enlace de youtube de tu video y haz clic en Guardar/Actualizar enlace </label>                    
            <div class="row form-group m-2">

              

              <label  class="control-label col-sm-2" for="nombre">Enlace del video:</label>


              <div class="col-sm-8">
                <input  type="text" class="form-control noborder" id="video1"  name="video1" value="'.$video1.'"  maxlength="499" >
              </div>
              <div class="col-sm-2">
                <a href="#" class="btn btn-primary" onclick="guardarVideo();" >Guardar/Actualizar enlace</a>
              </div>
               <div class="col-sm-1" id="video_ok">
                
              </div>
              
          </div> 
        </div>';
        
                        


    if(!($doc1||$doc2||$doc3||$doc4)){





                    echo'
                          <div class="row" id="anim">
                          
                            <div class="col-sm-5">
                                <div class="bg-info text-white anim1">
                                  <i class="fas fa-long-arrow-alt-down"></i> Descarga los formatos aquí   
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="bg-info text-white anim2" style="opacity:0;">
                                   Adjunta tus documentos aquí  <i class="fas fa-long-arrow-alt-down"></i> 
                                </div>
                            </div>
                            
                          </div>';
    }




    

   
 
    




   
        echo '<div class="row">
                <div class="col-sm-5">
                   <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Descargas</h4>';
                            if($categoria==1){ ///menor
                                echo '<div class="alert alert-info"><p>Descarga los siguientes formatos y llénalos con tinta azul.</p></div>';
                                //echo '<div class="m-15">*</div>';
                                 echo "<hr>";



                                                       
                               echo ' <div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_descarga/cartacesion_cat1.docx').'" target="_blank">1. Carta de cesión de derechos.</a></div>
                                      </div>';
                               
                                echo "<hr>";
                                
                                echo ' <div class="row">
                                            <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_descarga/declaracion_verdad.docx').'" target="_blank">2. Carta bajo protesta de decir verdad que la obra es original, personal e inédita.</a></div>
                                          </div>';
                                echo "<hr>";

                               

                                /*
                                 echo '<div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_concursos/debate/6_menor.docx').'" target="_blank">6.Formato Autorización a participar en caso de que la persona participante tenga la menoría de edad.</a></div>
                                      </div>';
                                      */

                                      



                            }else{
                               
                               echo '<div class="alert alert-info"><p>Descarga los siguientes formatos y llénalos con tinta azul.</p></div>';
                                //echo '<div class="m-15">*</div>';
                                 echo "<hr>";

                                 echo ' <div class="row">
                                        <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_descarga/cartacesion_cat2.docx').'" target="_blank">1. Carta de cesión de derechos.</a></div>
                                      </div>';
                               
                                echo "<hr>";
                                
                                echo ' <div class="row">
                                            <div class="col-sm-1"><i class="far fa-file-pdf"></i></div><div class="col-sm-11"><a href="descargarword.php?f='.base64_encode('documentos_descarga/declaracion_verdad.docx').'" target="_blank">2. Carta bajo protesta de decir verdad que la obra es original, personal e inédita.</a></div>
                                          </div>';
                                echo "<hr>";


                            }
                            
                        
                    echo '</div>
                   </div>
                </div>

                <div class="col-sm-7">
                
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


                           
                           

                        ////////////////////////////////////////////// 0
                                $doc1_64=base64_encode($doc1);
                                $tooltip0="Escanear en formato PDF tu identificación: acta de nacimiento, credencial para votar vigente, licencia para conducir, cartilla del Servicio Militar Nacional, pasaporte, cédula profesional o matrícula consular. En caso de menores de edad, deberán adjuntar su credencial de la escuela, pasaporte o cualquier otra identificación. Asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";
                                echo '<div class="row" id="row-0">
                                       
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

                                           

                                           

                                        </div>
                                        
                                    
                                      </div>';///row0

                        ////////////////////////////////////////////// 0
                                echo '<hr>';

                         ////////////////////////////////////////////// 1
                                $doc2_64=base64_encode($doc2);
                                $tooltip1="Copia de credencial para votar de padre, madre o tutor. En caso de no contar con credencial para votar, bastará presentar una carta de apoyo firmado por la madre, padre o tutor. Asegúrate que el archivo no sea mayor a 4MB";

                                if($categoria==1){
                                echo '<div class="row" id="row-1">
                                       
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

                                        </div>
                                        
                                    
                                      </div>';///row1


                        ////////////////////////////////////////////// 1
                                echo '<hr>';
                                }///cat1
                        ///////////////////////////////////////////// 2  ///// *doc1*
                                      $doc3_64=base64_encode($doc3);
                                      $tooltip2="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a. <i>Descarga el formato <b>1</b> de la columna de la izquierda.</i>";
                                //if($categoria==1){
                                //echo " / ".$categoria." /";
                                echo '<div class="row" id="row-2">
                                       
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
                                        
                                    
                                      </div>';
                                       echo '<hr>';
                                //} //$categoria==1
                        ///////////////////////////////////////////// 2
                                

                        ///////////////////////////////////////////// 3   
                        ////*doc2*
                                    $doc4_64=base64_encode($doc4);
                                    $tooltip3="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. En caso de menores de edad, la firma deberá ser de la madre, el padre o el tutor/a. <i>Descarga el formato <b>2</b> de la columna de la izquierda.</i>";
                                //if($categoria==1){
                                 // echo "/ ".$categoria." /";
                                echo '<div class="row" id="row-3">
                                       
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar Carta bajo protesta ... (2)  </div>
                                                <input type="file" id="file-select-3" class="form-control-file"  onchange="fnUpload('.$idusuario.',3)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip3.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>';
                                       echo '<hr>';
                                //}///$categoria==1
                        ///////////////////////////////////////////// 3

                        
                      /*

                        ///////////////////////////////////////////// 4
                                    $doc5_64=base64_encode($doc5);
                                      $tooltip4="Llenar y firmar con tinta azul el formato, escanearlo a color en formato PDF, asegurándose de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB. <i>Descarga el formato <b>1</b> de la columna de la izquierda.</i>";

                                if($categoria==2){
                                //echo "/".$categoria."/";
                                echo '<div class="row" id="row-4">
                                       
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
                                                <div class="btn-upload-custom"><i class="fas fa-upload"></i> Adjuntar formato de declaración de que la obra es original e inédita, así como la carta de cesión de derechos (1)</div>
                                                <input type="file" id="file-select-4" class="form-control-file"  onchange="fnUpload('.$idusuario.',4)" '.$validado_disabled.' >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-sm-1">
                                            

                                            <a href="#" data-toggle="tooltip" data-html="true" title="'.$tooltip4.'">
                                                <i class="far fa-question-circle"></i>
                                            </a>

                                        </div>
                                        
                                    
                                      </div>'; ///row3

                                        echo '<hr>';
                                }//$categoria==2

                        ///////////////////////////////////////////// 4

                        
                      

                        ///////////////////////////////////////////// 5
                                    $doc6_64=base64_encode($doc6);
                                      $tooltip5="Asegúrate que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB";

                                if($pais!=117){
                               // echo "//".$pais."//";
                                echo '<div class="row" id="row-5">
                                       
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
                                        
                                    
                                      </div>'; ///row3
                                        echo "<hr>";
                                }///$pais

                        ///////////////////////////////////////////// 5
                                     

                        ///////////////////////////////////////////// 6
                        
                                     $doc7_64=base64_encode($doc7);
                                      $tooltip6="Escanea en formato PDF, aseguúrate de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.<i> Descarga el formato número <b>2</b> de la columna de la izquierda</i> ";
                                echo '<div class="row" id="row-6">
                                       
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
                                        
                                    
                                      </div>'; ///row3
                        
                        ///////////////////////////////////////////// 6
                                       //echo "<hr>";

                        if($edad>=18){
                            $menoria=" style='display:none;' ";
                        }else{
                            $menoria="";
                        }

                         ///////////////////////////////////////////// 7
                         /*
                                    $doc8_64=base64_encode($doc8);
                                      $tooltip7="Escanea en formato PDF, asegúrate de que ajuste a una hoja tamaño carta y que el archivo no sea mayor a 4MB.";
                                echo '<div class="row" id="row-7" '.$menoria.'>
                                       
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
                                        
                                    
                                      </div>'; ///row3
                        */
                        ///////////////////////////////////////////// 7
                              

                        

                                    ////card
                echo '</div>
                   </div>
                </div>
                

                
            
              </div>';///row principal
  

    //echo '<hr>';




  

   

    



   	echo '<div id="errormsg"></div>';

   
  }else{
  	echo "No resgistrado";
  }

 ?>