<?php
session_start();
$idusuario=$_SESSION['idusuario'];

$id=$_POST['id'];
$categoria=$_POST['categoria'];
$pais=$_POST['pais'];


if(isset($_POST['action'])){
	$action=$_POST['action'];

}else{
	$action="";
}



include('phpmailer/class.phpmailer.php');
include('phpmailer/class.smtp.php');
include('phpmailer/PHPMailerAutoload.php');
include('sqlconnector.php');

include('rutasitio.php');
include('cat_alcaldia.php');


define("UPLOAD_DIR", "uploads/");



if($action=='update'){//////////////////código del update y el correo

		$id=$_POST["id"];

		$edad=$_POST['edad'];


		//echo "  /".$edad."/   ";



    	$status_doc1=$_POST["status_doc1"];
    	$observa_doc1=$_POST["observa_doc1"];


      $status_doc2=$_POST["status_doc2"];
      $observa_doc2=$_POST["observa_doc2"];


      $status_doc3=$_POST["status_doc3"];
      $observa_doc3=$_POST["observa_doc3"];





    	$status_doc4=$_POST["status_doc4"];
    	$observa_doc4=$_POST["observa_doc4"];

     /*
      $status_doc5=$_POST["status_doc5"];
      $observa_doc5=$_POST["observa_doc5"];



    	$status_doc6=$_POST["status_doc6"];
    	$observa_doc6=$_POST["observa_doc6"];


    	$status_doc7=$_POST["status_doc7"];
    	$observa_doc7=$_POST["observa_doc7"];
*/


    	$observa_requi=$_POST['observa_requi'];

    	//$status_requisitos=$_POST['status_requisitos'];




    	$cat_categoria=array("0","A","B","C","D");



	    $query1="SELECT COUNT(id) as numero FROM ".BD_PARTICIPANTES." where folio is not null AND categoria=".$categoria."";

		  $row = sqlsrv_query($conn,$query1);
          if($res=sqlsrv_fetch_array($row))
          {

          	$num=intval($res['numero'])+1;
          	//echo "  **".$num."**  ";
          }else{

          	//echo "1"	;
            die( print_r( sqlsrv_errors(), true));
            ///echo '<a href="maindistrito.php" class="btn btn-primary">Haz clic aquí para continuar</a>';

          }


          	$prefijo="VFF";


          $folio=$prefijo."-".$cat_categoria[$categoria]."-".$num;
          $checkfolio=true;

          while($checkfolio){

          	$query2="SELECT count(id) as existe FROM ".BD_PARTICIPANTES." where folio='".$folio."'";

			  $row = sqlsrv_query($conn,$query2);
	          while($res=sqlsrv_fetch_array($row))
	          {
	          	$existe=intval($res["existe"]);
	          	///echo " --".$existe."--  //".$num."//  ";
	          	if($existe>=1){
	          		$num++;
	          		 $folio=$prefijo."-".$cat_categoria[$categoria]."-".$num;
	          		$checkfolio=true;
	          		//echo "   if:true   ";

	          	}else{
	          		$checkfolio=false;
	          		//echo "   if:false   ";


	          	}


	          }

          }

    $validado=false;
    $status=2;


   if($pais==117){

       if($categoria==1){
          if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'){

              $validado=true;

          }
        }///1

        if($categoria==2){
            if($status_doc1=='1'&&$status_doc3=='1'&&$status_doc4=='1'){

               $validado=true;


            }

        }////2

    }else{   ////extranjero

        if($categoria==1){
          if($status_doc1=='1'&&$status_doc2=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
            $validado=true;

          }
        }///1

        if($categoria==2){
            if($status_doc1=='1'&&$status_doc3=='1'&&$status_doc4=='1'){
             $validado=true;


            }

        }////2
    }

    if($validado){
    	 $status=3;

    	$query="UPDATE ".BD_PARTICIPANTES." SET status_doc2=$status_doc2, observa_doc2='$observa_doc2', status_doc1=$status_doc1, observa_doc1='$observa_doc1',  status_doc4=$status_doc4, observa_doc4='$observa_doc4', status_doc3=$status_doc3, observa_doc3='$observa_doc3', observa_requisitos='$observa_requi', folio='$folio', status_requisitos=$status, validador=$idusuario WHERE id=$id ";

    }else{

    	$query="UPDATE ".BD_PARTICIPANTES." SET status_doc2=$status_doc2, observa_doc2='$observa_doc2', status_doc1=$status_doc1, observa_doc1='$observa_doc1',  status_doc4=$status_doc4, observa_doc4='$observa_doc4', status_doc3=$status_doc3, observa_doc3='$observa_doc3', observa_requisitos='$observa_requi', status_requisitos=$status, validador=$idusuario WHERE id=$id ";

    }






//echo $query;

		  $row = sqlsrv_query($conn,$query);
          if($row)
          {

	          	if($validado){
	          		echo '<div class="alert alert-success" >
	          		<p>Datos guardados con éxito</p>
	          		<p>Se asignó el folio: '.$folio.'</p></div>';

	          	echo '<div class="row" style="margin-bottom: 10px;">

	                   <div class="col-sm-5">

	                     <a href="maincentrales.php" class="btn btn-secondary">Regresar</a>
	                   </div>
	                </div>';

	          	}else{
		          	echo '<div class="alert alert-success" >
		          		<p>Datos guardados con éxito</p>
		          		<p>No se asignó un número de folio. Al estar incorrectos o incompletos alguno de los documentos.</p></div>';

		          	echo '<div class="row" style="margin-bottom: 10px;">

		                   <div class="col-sm-5">

		                     <a href="maincentrales.php" class="btn btn-secondary">Regresar</a>
		                   </div>
		                </div>';
	            }

          	$guardado=true;
          }else{
          	echo '<div class="alert alert-warning" >
          		<p>Error al guardar en la base de datos</p></div>';
          		echo '<div class="row" style="margin-bottom: 10px;">

                   <div class="col-sm-5">

                     <a href="maincentrales.php" class="btn btn-secondary">Regresar</a>
                   </div>
                </div>';
          	$guardado=false;

          }

          if($guardado){

          	$query= "SELECT B.correo,B.nombre, B.paterno, B.materno FROM ".BD_PARTICIPANTES." as A INNER JOIN ".BD_USUARIOS." as B ON A.idusuario= B.idusuario and id=".$id." ";

			  $row = sqlsrv_query($conn,$query);
	          if($res=sqlsrv_fetch_array($row))
	          {

	          	$correo=$res['correo'];
	          	$nombre=$res['nombre']." ".$res['paterno']." ".$res['materno'];
	          	//echo "  **".$num."**  ";
	          }else{

	          	//echo "1"	;
	            die( print_r( sqlsrv_errors(), true));
	            ///echo '<a href="maindistrito.php" class="btn btn-primary">Haz clic aquí para continuar</a>';

	          }

          	/////////////////////////////////////////////correo

          			$mail = new PHPMailer(true);
					//Luego tenemos que iniciar la validación por SMTP:
					$mail->IsSMTP();
					$mail->CharSet = 'utf-8';
					$mail->SMTPAuth = false;
					$mail->Host = "145.0.40.63"; // SMTP a utilizar. Por ej. smtp.elserver.com
					$mail->Username = "actividadesccycp@iecm.mx"; // Correo completo a utilizar
					$mail->Password = "s1s3c0m"; // Contraseña
					$mail->Port = 25; // Puerto a utilizar
					$mail->From = "no-reply@iecm.mx"; // Desde donde enviamos (Para mostrar)
					$mail->FromName = "Instituto Electoral de la Ciudad de México";

          	if ($validado){
          		//////correo OK

          		$folio_64=base64_encode("/jF5i/".$folio."/jF5i/");

          		$html='
					<html>
					<body style="width:80%; display: block; margin: 0 auto;">
					<table width="353" border="0">
			  			<tbody>
				    		<tr>
				      			<td width="218"><img src="'.URL_CONCU.'/img/header20_1.png" width="146" height="151"></td>
						      	<td width="805"><h1 style="color:#6611AA;"> VOTAFILMFEST 2021</td>
				    		</tr>
			  			</tbody>
					</table>
					<hr>

					<div style="align:center">
							<p align="justify"><h3>Estimado(a) '.$nombre.'.</h3></p>

							<br>

							<p align="justify">Has completado correctamente el registro en la cuarta edición del concurso VOTA FILM FEST 2021.</p>
							<br>
							<div style="display:block; margin:0 auto; text-align:center; max-width: 70%; border:1px solid #EEE;">
								<p>Tu número de folio es: <b>'.$folio.'</b></p>

							</div>

							<p>Descarga el acuse de registro en <a href="'.URL_CONCU.'descargaracuseweb.php?v='.$folio_64.'">este enlace</a></p>

							<br>

					    </div>

						<strong><p align="center"><font size="3pt">Instituto Electoral de la Ciudad de M&eacute;xico <br/>
					      Huizaches 25 &bull; Rancho Los Colorines &bull; Tlalpan &bull; C.P. 14386 &bull; Ciudad de M&eacute;xico  &bull; Conmutador: (55) 5483 3800</font></p>
					      </strong>
					        </div>
					</body>
					</html>';


          		///////ok

          	}else{

          		/////correro NOT OK


          		$html='
					<html>
					<body style="width:80%; display: block; margin: 0 auto;">
					<table width="353" border="0">
			  			<tbody>
				    		<tr>
				      			<td width="218"><img src="'.URL_CONCU.'/img/header20_1.png" width="146" height="151"></td>
						      	<td width="805"><h1 style="color:#6611AA;"> VOTAFILMFEST 2021</h1> </td>
				    		</tr>
			  			</tbody>
					</table>
					<hr>

					<div style="align:center">
						<p align="justify"><h3>Estimado(a) '.$nombre.'.</h3></p>

							<br>


						<p align="justify">Este correo automático ha sido enviado para notificar que la documentación proporcionada para VOTA FILM FEST 2021 está incompleta o incorrecta.</p>
						<p> Aquí las observaciones sobre cada uno de los documentos:</p>';




							if($status_doc1==1) $var_A="Correcto";
							else $var_A="Incorrecto";

							if($status_doc2==1) $var_B="Correcto";
							else $var_B="Incorrecto";

							if($status_doc3==1) $var_C="Correcto";
							else $var_C="Incorrecto";

							if($status_doc4==1) $var_D="Correcto";
							else $var_D="Incorrecto";







						$html.='<div style="display:block; margin:0 auto; text-align:center; max-width: 70%; border:1px solid #EEE;">';
						$html.='<table>
								<tr style="border-bottom:1px solid #EEE; font-weight:700;">
									<td>Documentos</td>
									<td>Estatus</td>
									<td>Observaciones</td>
								</tr>


								<tr style="border-bottom:1px solid #EEE;">
									<td>Identificación oficial</td>
									<td>'.$var_A.'</td>
									<td>'.$observa_doc1.'</td>
								</tr>

								';

								if($categoria==1){

								$html.='<tr style="border-bottom:1px solid #EEE;">
									<td>Identificación tutor</td>
									<td>'.$var_B.'</td>
									<td>'.$observa_doc2.'</td>
								</tr>';
								}


									$html.='<tr style="border-bottom:1px solid #EEE;">
										<td>Cesión de derechos</td>
										<td>'.$var_C.'</td>
										<td>'.$observa_doc3.'</td>
									</tr>';



							$html.='<tr style="border-bottom:1px solid #EEE;">
									<td>Carta bajo protesta de decir verdad que la obra es inédita</td>
									<td>'.$var_D.'</td>
									<td>'.$observa_doc4.'</td>
								</tr>';


							$html.='</table>
							<p> Observación general: '.$observa_requi.'</p>
							</div>

							<p>Para corregir los archivos, es necesario ingresar con usuario y contraseña para subir los nuevos archivos, <a href="'.URL_CONCU.'index.php"> haciendo clic aquí</a></p>



						</div>

							<div>
					          <strong>
							<p align="center"><font size="3pt">Instituto Electoral de la Ciudad de M&eacute;xico<br />
					          Huizaches 25 &bull; Rancho Los Colorines &bull;  Tlalpan &bull; C.P. 14386 &bull; Ciudad de M&eacute;xico  &bull; Conmutador: (55) 5483 3800</font></p>
					             </strong>
					        </div>
					</body>
					</html>';

          		/////not ok

          	}

          	 				try{
								//$destinatario1 = 'nancy.hernandez@iecm.mx';
								$destinatario2 = 'sergio.monterrubio@iecm.mx';


								//$mail->AddAddress($destinatario1); // Esta es la dirección a donde enviamos
								$mail->AddAddress($correo); // Esta es la dirección a donde enviamos
								//$mail->AddAddress($email);
								//$mail->AddAddress($destinatario2);// Esta es la dirección a donde enviamos
								//$mail->AddAddress($destinatario3);// Esta es la dirección a donde enviamos

								///////////////------>>>>>
								//$mail->AddCC("inscripciones@iedf.org.mx"); // Copia
								//$mail->AddBCC("inscripciones@iedf.org.mx"); // Copia oculta

								$mail->AddBCC("sergio.monterrubio@iecm.mx"); // Copia oculta
								//$mail->AddBCC("concursos@iecm.mx"); // Copia oculta



								$mail->IsHTML(true); // El correo se envía como HTML
								$mail->Subject = "VOTAFILMFEST 2021"; // Este es el titulo del email.
								$mail->Body = $html; // Mensaje a enviar

								$exito = $mail->Send(); // Envía el correo.


								//$exito ="1";//
								//$exito =0;//

									if($exito):


									else:





									endif;
							}//try
							catch (Exception $e) {

							      echo "Excepción: ".$e->getMessage();
							};//catch



                    		$mail->ClearAddresses();



          	//////////////////////////////////////////////fin correo





          }


///////////////////////////////////////////// fin código del update y el correo




}else{//////////////////////////////////////////////código con el listado de archivo

		$query="SELECT * FROM ".BD_PARTICIPANTES." WHERE id =".$id."";

		$res=sqlsrv_query($conn,$query);
		$row= sqlsrv_fetch_array($res);

		$nombre=$row['nombre']." ".$row['paterno']." ".$row['materno'];

		$categoria=$row["categoria"];
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

		$observa_requisitos=$row["observa_requisitos"];
		$status_requisitos=$row["status_requisitos"];

		$fecha_nacimiento=$row["fecha_nacimiento"];

		$video=$row['video'];





    $fecha_fin_concurso="2021-11-30";
    //$fecha_fin_concurso="2020-07-21";
 	//$años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
    $edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_concurso))->y;

    $status_label=array("Por completar documentación","Documentación completa / en revisión","Revisión / Error en documentación","Validado / Folio asignado","4?","???");
    $categoria_label=array("","12 a 17 años"," 18 a 29 años");



		echo '<hr>';
		echo '<p>'.$nombre.'</p>';
		echo '<p>Categoría: '.$categoria_label[$categoria].'</p>';
		echo '<p>País: '.$paises[$pais].'</p>';
		echo '<p>Estatus: '.$status_label[$status_requisitos].'</p>';

		echo '<hr>';

		echo '<h2>Video</h2>';

		$link=urldecode($video);

		$parsed = parse_url($link);
		if (empty($parsed['scheme'])) {
		    $link = 'http://' . ltrim($link, '/');
		}

		echo '<p>Video: <a href="'.$link.'" target="_blank">'.urldecode($video).'</a></p>';

		//echo '  <iframe width="420" height="315" src="'.$link.'"> </iframe>  ';

		echo '<hr>';



		echo '<h2>Validación de documentos</h2>';
		echo '<hr>';

		?>

		<div class="row headerconsultas">
			<div class="col-sm-4">
				Documento
			</div>
			<div class="col-sm-2">
				Estatus
			</div>
			<div class="col-sm-6">
				Observaciones
			</div>
		</div>
		<div class="row rowconsultas">

			<input type="hidden" id="id" name="id" value=<?php echo $id;?>>
			<input type="hidden" id="categoria" name="categoria" value=<?php echo $categoria;?>>
			<input type="hidden" id="pais" name="extranjero" value=<?php echo $pais;?>>

			<input type="hidden" id="edad" name="edad" value=<?php echo $edad;?>>




		</div>

		<!------ doc1 -->

		<div class="row rowconsultas">

			<div class="col-sm-4">
				<?php
				if($doc1){
					echo '<a href="'.UPLOAD_DIR.$doc1.'" class="btn btn-primary" target="_blank">Ver Identificacion Oficial</a>';
				}
				else{
					echo 'No existe Identificacion Oficial';
				}
				?>
			</div>


			<div class="col-sm-2">
				<select class="custom-select" name= "select_status_doc1" id="select_status_doc1">
					<option  value="0" disabled <?php if($status_doc1==0) echo 'selected';?> >Nuevo</option>
					<option  value="1" <?php if($status_doc1==1) echo 'selected';?> >Correcto</option>
					<option  value="2" <?php if($status_doc1==2) echo 'selected';?> >Incorrecto</option>
				</select>
			</div>

			<div class="col-sm-6">
				<input type="text" class="form-control noborder" name= "observa_doc1" id="observa_doc1" value="<?php echo $observa_doc1;?>" maxlength="799">
			</div>

		</div>

	<!------ doc2 -->

		<div class="row rowconsultas">
			<div class="col-sm-4">
				<?php
				if($doc2){
					echo '<a href="'.UPLOAD_DIR.$doc2.'" class="btn btn-primary" target="_blank">Ver identificación tutor</a>';
				}
				else{
					echo 'No existe identificación tutor';
				}
				?>
			</div>




			<div class="col-sm-2">
				<select class="custom-select" name= "select_status_doc2" id="select_status_doc2">
					<option  value="0" disabled <?php if($status_doc2==0) echo 'selected';?> >Nuevo</option>
					<option  value="1" <?php if($status_doc2==1) echo 'selected';?> >Correcto</option>
					<option  value="2" <?php if($status_doc2==2) echo 'selected';?> >Incorrecto</option>
				</select>
			</div>

			<div class="col-sm-6">
				<input type="text" class="form-control noborder" name= "observa_doc2" id="observa_doc2" value="<?php echo $observa_doc2;?>" maxlength="799">
			</div>
		</div>


		<!------ doc3 -->

		<div class="row rowconsultas">

			<div class="col-sm-4">
				<?php
				if($doc3){
					echo '<a href="'.UPLOAD_DIR.$doc3.'" class="btn btn-primary" target="_blank">Carta de cesión de derechos</a>';
				}
				else{
					echo 'No existe carta de cesión de derechos';
				}
				?>
			</div>



			<div class="col-sm-2">
				<select class="custom-select" name= "	select_status_doc3" id="select_status_doc3">
					<option  value="0" disabled <?php if($status_doc3==0) echo 'selected';?> >Nuevo</option>
					<option  value="1" <?php if($status_doc3==1) echo 'selected';?> >Correcto</option>
					<option  value="2" <?php if($status_doc3==2) echo 'selected';?> >Incorrecto</option>
				</select>
			</div>


			<div class="col-sm-6">
				<input type="text" class="form-control noborder" name= "observa_doc3" id="observa_doc3" value="<?php echo $observa_doc3;?>" maxlength="799">
			</div>
		</div>

		<!-- doc4 -->


		<div class="row rowconsultas">
			<div class="col-sm-4">
				<?php
				if($doc4){
					echo '<a href="'.UPLOAD_DIR.$doc4.'" class="btn btn-primary" target="_blank">Ver carta bajo protesta...</a>';
				}
				else{
					echo 'No existe carta bajo protesta...';
				}
				?>
			</div>


			<div class="col-sm-2">
				<select class="custom-select" name= "select_status_doc4" id="select_status_doc4">
					<option  value="0" disabled <?php if($status_doc4==0) echo 'selected';?> >Nuevo</option>
					<option  value="1" <?php if($status_doc4==1) echo 'selected';?> >Correcto</option>
					<option  value="2" <?php if($status_doc4==2) echo 'selected';?> >Incorrecto</option>
				</select>
			</div>


			<div class="col-sm-6">
				<input type="text" class="form-control noborder" name= "observa_doc4" id="observa_doc4" value="<?php echo $observa_doc4;?>" maxlength="799">
			</div>
		</div>



		<hr>


		<div class="row rowconsultas">

			<label class="control-label col-sm-4" for="nombre"> Observaciones sobre el cumplimiento de requisitos</label>

			<div class="col-sm-8">

				<textarea class="form-control noborder" name="observa_requi" id="observa_requi" maxlength="799"><?php echo $observa_requisitos;?></textarea>

			</div>
		</div>





		<div id="div_guardar" class="row">

			<div id="errorMsg"></div>

			<input type="submit" value="Guardar" id="btn_guardar" class="control-form btn btn-primary btnguardar" onclick="this.disabled=true; fnguardarvalidaciones()">

		</div>
		<?php
}

?>
