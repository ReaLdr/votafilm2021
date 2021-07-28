
<?php

	include('sqlconnector.php');

	$vg_mes=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');



	$folio=$_POST['folio'];

	echo $folio;

		  $query1="SELECT * FROM ".BD_PARTICIPANTES." where folio='".$folio."'";


		  $row = sqlsrv_query($conn,$query1);
          if($res=sqlsrv_fetch_array($row))
          {

          $nombre=$res["nombre"]." ".$res["paterno"]." ".$res["materno"];



	      $fecha_nacimiento=$res["fecha_nacimiento"];
	      //$fecha_alta=$res["fecha_alta"];



       $cat=$res['categoria'];

        if($cat==1){
          $categoria="A: 12 a 17 años";
        }else{
          $categoria="B: 18 a 29 años";

        }




          	//echo "  **".$num."**  ";
          }else{

          	//echo "1"	;
            die( print_r( sqlsrv_errors(), true));
            ///echo '<a href="maindistrito.php" class="btn btn-primary">Haz clic aquí para continuar</a>';

          }

          $edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_concurso))->y;
          $doc1="Sí";
          $doc2="Sí";
          $doc3="Sí";
          $doc4="Sí";
          if($file_doc8){
            $doc8="Sí";
          }else{
            $doc8="No";
          }

          $dia=date_format(date_create(),"d");
          $mes_num=intval(date_format(date_create(),"m"));
          $mes=$vg_mes[$mes_num];


          $fecha=$dia." de ".$mes;



    $full_path = 'documentos_descarga/acuse'.rand(1,3).'-'.rand(1,3).'.docx';
    //Copy the Template file to the Result Directory






      copy("documentos_descarga/acuse2020.docx", $full_path);






  	/*$full_path = 'documentos_concursos/cuento/acuse'.rand(1,3).'-'.rand(1,3).'.docx';
    //Copy the Template file to the Result Directory
    copy("documentos_concursos/cuento/acuse.docx", $full_path);*/

    // add calss Zip Archive
    $zip_val = new ZipArchive;

    //Docx file is nothing but a zip file. Open this Zip File
    if($zip_val->open($full_path) == true)
    {
        // In the Open XML Wordprocessing format content is stored.
        // In the document.xml file located in the word directory.

        $key_file_name = 'word/document.xml';
        $message = $zip_val->getFromName($key_file_name);

        $timestamp = date('d-M-Y H:i:s');

        // this data Replace the placeholders with actual values
        $message = str_replace("{nombre}", $nombre, $message);
        $message = str_replace("{folio}", $folio, $message);
        $message = str_replace("{categoria}", $categoria, $message);


         $message = str_replace("{fecha}", $fecha, $message);
         // $message = str_replace("{mes}", $mes, $message);


        //Replace the content with the new content created above.
        $zip_val->addFromString($key_file_name, $message);
         //$zip_val->extractTo('test');
        $zip_val->close();




      }
/*    ob_start();

    header("Content-Type: application/msword");
	header("Content-Disposition: attachment; filename=acuse.docx");
	header("Content-Length: " . filesize($full_path));
	header("Content-Transfer-Encoding: binary");
	readfile($full_path);
	ob_end_flush();*/

	 	header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename=acuse-'.$folio.'.docx');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($full_path));
        ob_clean();
        flush();
        readfile($full_path);
        //exit();


        unlink($full_path);

 		ignore_user_abort(true);
		if (connection_aborted()) {
		    unlink($full_path);
		}






?>
