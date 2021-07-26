<?php
//include('valida_session.php');
include('sqlconnector.php');
define("UPLOAD_DIR", "uploads/");
//$_FILES['archivo']['tmp_name']

//echo "upload.php / ";
//print_r($_FILES);

$v_id=$_POST['idusuario'];
$v_index=$_POST['index'];
$upload_max=4000000;




$documento=array("ident","id_tutor","cartacesiond","cartaprotes","declaracion_mayor","consular","justificacion");


function return_bytes($val)
{
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= (1024 * 1024 * 1024); //1073741824
            break;
        case 'm':
            $val *= (1024 * 1024); //1048576
            break;
        case 'k':
            $val *= 1024;
            break;
    }

    return $val;
}


//$v_observaciones=$_POST['observaciones'];
//echo " / ".$myvaaar." / ";

  /*  $upload_max = return_bytes(ini_get('upload_max_filesize'));

    $post_max_size = return_bytes(ini_get('post_max_size'));


      echo "1:  ".$upload_max."<br>";
      echo "2:  ".$post_max_size."<br>";
      echo "3:  ". $_FILES['file-select']['size'] ."<br>";
       echo "4:  ". empty($_FILES["file-select"]) ."<br>";
        echo "5:  ".isset($_FILES["file-select"]) ."<br>";
*/




if (isset($_FILES["file-select"])) {
    $myFile = $_FILES["file-select"];


    
/*
    if($_FILES['file-select']['size'] > $upload_max) {
      echo "1:".$upload_max."<br>";
      echo "2:".$post_max_size."<br>";
      echo "3:". $_FILES['file-select']['size'] ."<br>";
      exit;
    } 
*/






    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        //$m_error=UploadException($myFile['file-select']['error']);
        echo '<div class="alert alert-warning alert-dismissible fade show"">
                ERROR 1: No se pudo guardar el archivo.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
              </div>';
        if ($myFile["error"] > 0) {
          echo "Return Code: " . $myFile["error"] . "<br>";
        }
        exit;
    }

    ///////////////////////////////pdf

    $tipoArchivo = $myFile["type"];
    
  
//echo "llego al tipo".$tipoQueja.$tipoAcuerdo;
  
  if ($tipoArchivo != "application/pdf")
    {
        
  
   
    
    echo '<div class="alert alert-warning alert-dismissible">
           Error : Sólo se permiten subir archivos con extension PDF
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
           </div>';
          
     exit;
    }


    if($_FILES['file-select']['size'] > $upload_max) {

        echo '<div class="alert alert-warning alert-dismissible">
            El tamaño del archivo excede el límite permitido.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
           </div>';
      
      exit;
    } 




    // ensure a safe filename
     

    
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);
    


    if(!is_dir(UPLOAD_DIR.$v_id."/")) {
        mkdir(UPLOAD_DIR.$v_id."/");
    }

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);

    $name= $documento[$v_index].".".$parts["extension"];

    while (file_exists(UPLOAD_DIR .$v_id."/". $name)) {
        $i++;
        $name = $documento[$v_index] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR .$v_id."/". $name);
    if (!$success) {
        //$m_error=UploadException($myFile['tmp_name']['error']); 
        echo '<div class="alert alert-danger alert-dismissible">
                  ERROR 2: No se pudo guardar el archivo
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>

              </div>';
        if ($success["error"] > 0) {
          echo "Return Code: " . $success["error"] . "<br>";
        }
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR .$v_id."/". $name, 0644);
    $ruta_docto_=$v_id."/".$name;


        

                                               //id_seguimiento, 
   

    if($v_index==0){
        $query= "UPDATE ".BD_PARTICIPANTES." SET doc1= '". $ruta_docto_."', status_doc1='0'  where idusuario=".$v_id."";//observa_identifica
    }

     if($v_index==1){
        $query= "UPDATE ".BD_PARTICIPANTES." SET  doc2= '". $ruta_docto_."', status_doc2='0' where  idusuario=".$v_id.""; //observa_boceto
    }

       

    if($v_index==2){
        $query= "UPDATE ".BD_PARTICIPANTES." SET  doc3= '". $ruta_docto_."', status_doc3='0'  where idusuario=".$v_id."";//observa_carta
    }

    if($v_index==3){
        $query= "UPDATE ".BD_PARTICIPANTES." SET  doc4= '". $ruta_docto_."', status_doc4='0'  where idusuario=".$v_id."";//observa_formato
    }

    if($v_index==4){
        $query= "UPDATE".BD_PARTICIPANTES." SET  doc5= '". $ruta_docto_."', status_doc5='0'  where idusuario=".$v_id."";//observa_manifest
    }

   

   

     
      
    

       


        



      //echo "consulta: ".$query;
      $row=sqlsrv_query($conn,$query);

      if($row){
        //echo ' <a href="'.UPLOAD_DIR .$ruta_docto_.'" target="_blank" class="btn-icon"><i class="fas fa-file-signature"></i><i class="far fa-thumbs-up"></i></a>';//

        echo '<div class="alert alert-success alert-dismissible">
                Archivo actualizado con éxito
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>';



                      /////////////////////bitacora
                      $ip_v4=$_SERVER['REMOTE_ADDR'];
                      
                      /*
                      $queryB = "INSERT INTO sisecom_convocatorias_bitacora(usuario, ip,accion,texto,fecha) 
                        values (".$tmpses_idusr.",'".$ip_v4."','uploadOK_".$v_tipo."','id_".$v_id."','".date('Y-m-d H:i:s')."')";
                     
                      
                      $rowB = sqlsrv_query($conn,$queryB);
                      if($rowB)
                      {
                        //echo "bitacora OK";

                      }else{
                        die( print_r( sqlsrv_errors(), true));

                      }
                      */
                      //////////////////////fin bitacora
                

      }else{
        echo '<div class="alert alert-danger"> Error: al guardar el archivo'.print_r(sqlsrv_errors()).'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>

              </div>'; 
        //echo "/* ".$query." */";

                 /////////////////////bitacora
              /*
                      $ip_v4=$_SERVER['REMOTE_ADDR'];
                      
                      //$valor=sqlsrv_fetch_array( sqlsrv_query($conn,"SELECT IDENT_CURRENT ('sisecom_convocatorias') AS Current_Identity") );
                      //$ultimoregistro=$valor['Current_Identity'];

                      $queryB = "INSERT INTO sisecom_convocatorias_bitacora(usuario, ip,accion,texto,fecha) 
                        values (".$tmpses_idusr.",'".$ip_v4."','uploadERROR_".$v_tipo."','id_".$v_id."','".date('Y-m-d H:i:s')."')";
                     
                      
                      $rowB = sqlsrv_query($conn,$queryB);
                      if($rowB)
                      {
                        //echo "bitacora OK";

                      }else{
                        die( print_r( sqlsrv_errors(), true));

                      }
                      //////////////////////fin bitacora
              */
      }


}



?>