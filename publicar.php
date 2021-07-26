<?php
	include('phpmailer/class.phpmailer.php');
	include('phpmailer/class.smtp.php');
	include('phpmailer/PHPMailerAutoload.php');
	include 'valida_session.php';
	include('dbconnection.php');
	include 'cat_tipo_ord_ext.php';
	define("URL_SISECOM", "http://145.0.40.76/concursos2019/");
	define("UPLOAD_DIR", "uploads/");

	
	error_reporting(0);

	$usuario=$_POST['usuario'];
	$id_convocatoria=$_POST['convocatoria'];

	$vg_mes=array('','enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');

	$pueblos=array(297,298,299,305,911,929,934,940,941,942,943,944,945,946,947,948,949,950,1229,1230,1232,1235,1236,1238,1240,1320,1355,1375,1380,1381,1383,1386,1389,1469,1476,1477,1484,1485,1486,1489,1491,1493,1495,1497,1498,1499);

	$dd=date('d');
	$mm=$vg_mes[date('n')];
	$yyyy=date('Y');

	$clave_colonia=$tmpses_clavecol;
	$nombre_colonia=$tmpses_nomcoloniausr;
	$nombre_delegacion=$tmpses_nomdelegusr;

	function ocultaremail($email)
	{
	    $em   = explode("@",$email);
	    $name = implode(array_slice($em, 0, count($em)-1), '@');
	    $len  = floor(strlen($name)/2);

	    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
	}

////////////////////correo
	

    //echo " / ".$query1." / ".$email." / ";

//////////////////////////datos de la convocatoria
     $query2 = "SELECT * FROM sisecom_convocatorias where id_convocatoria=".$id_convocatoria." ";
   //$tmpqueryusuario="select * FROM sisecom_usuarios_comites";
    $row2 = sqlsrv_query($conn,$query2);
    if($res2 = sqlsrv_fetch_array($row2))
    {

    //echo '<option value="'.$res['id_colonia'].'" >'.$res['nombre_colonia'].'</option>';

      //$id_sesion_asamblea=$res['id_convocatoria'];
    	 $id_colonia=$res2['id_colonia'];
      $num_sesion_asamblea=$res2['num_convocatoria'];
      $tipo_sesion_asamblea=$res2['cattipo_id_sa'];
      $tipo_ord_ext=$res2['cattipo_idtipo_sa'];
      $sin_convocatoria=$res2['sin_convocatoria'];
      $clave_colonia_conv=$res2['clave_colonia'];

      $fecha=$res2['fecha_sa'];

      $hora_uno=$res2['hora_uno_convocatoria'];
      $hora_dos=$res2['hora_dos_convocatoria'];

      $domicilio=$res2['domicilio'];

      $convocatoria_pdf=$res2['convocatoria_pdf'];
      $acta_pdf=$res2['acta_pdf'];
      $id_usuario_creador=$res2['id_usuario'];

    
    
       
    }
    if($tipo_ord_ext=='1'){
    	$tipo_ord="X";
    	$tipo_ext="";
    }
    if($tipo_ord_ext=='2'){
    	$tipo_ord="";
    	$tipo_ext="X";
    }

  $query3 = "SELECT * FROM sisecom_convocatorias_ordendia where id_convocatoria=".$id_convocatoria." ORDER BY id_ordendia ASC";
   //$tmpqueryusuario="select * FROM sisecom_usuarios_comites";
    $asuntos=array();
    $row3 = sqlsrv_query($conn,$query3);
    while($res3 = sqlsrv_fetch_array($row3))
    {

    //echo '<option value="'.$res['id_colonia'].'" >'.$res['nombre_colonia'].'</option>';

      $asuntos[]=$res3['asunto'];

    
    
       
    }

    


    		$query4 = "UPDATE sisecom_convocatorias SET status='2' where id_convocatoria=".$id_convocatoria."";

		    $row4 = sqlsrv_query($conn,$query4);
		      if($row4)
		      {
		      	//echo '<div class="alert alert-success">Status</div>';

		      }else{
		        die( print_r( sqlsrv_errors(), true));
		      }

			$query5= "SELECT email FROM sisecom_convocatorias_usuarios_comites where id_usuario=".$id_usuario_creador."";

    		$row5 = sqlsrv_query($conn,$query5);
         	while($res5 = sqlsrv_fetch_array($row5))
            {
            	$email_creador=$res5['email'];
    		
    		}




    		if($email_creador===NULL){
    			$email_creador=" -No hay correo registrado-";
    		}








	
		$fecha_notifica = date("Y-m-d H:i:s");
		//include("switch.php");
		//include ('var_globales.php');

				
						//$string = utf8_encode($dirCorreo);
						//$control = "qwerty"; //defino la llave para encriptar la cadena, cambiarla por la que deseamos usar
						//$string = $control.$string.$control; //concateno la llave para encriptar la cadena
						$string = base64_encode($dirCorreo);//codifico la cadena
						
					$html = ' 
						<html> 
							<head> 
							 <title>Sistema de registro de convocatorias</title> 
							</head> 
						
							<body style="width:80%; display: block; margin: 0 auto;">
							<div style="display:inline-block;">

								<div style="display:inline-block;">
									<img src="'.URL_SISECOM.'img/iecm-logo-small.png" width="100"> 
								</div>
							
								
								<div style="display:inline-block; padding-bottom:20px;">

									<h1><span style="color: #32215C;">Sistema de registro de </span> <span style="color: #8C65AA;">convocatorias</span></h1>
								</div>
							</div>

							<hr>

							';



			///////////////////////////////////////////////Cuerpo de correo

				if($tipo_sesion_asamblea=='1'){
						$html.='<p align="center"><h2>Con fundamento en lo establecido en los artículos 100, 155, 156, 158 y 229 de la Ley de Participación Ciudadana, pongo a su consideración la Convocatoria a Sesión del Pleno siguiente:</h2><p>
						<br>

						<p> Se llevará a cabo en: <b>'.$domicilio.'</b></p>
						<p>Con fecha: <b>'.$fecha.'</b></p>
						 <p>A las: <b>'.$hora_uno.'</b></p>
						 <p>Segundo horario: <b>'.$hora_dos.'</b></p>

						 <p>Con el siguiente orden del día:</p>

						

						
						<!--<b>Habitantes de la colonia '.$nombre_colonia.'</b>
						<p>Ciudad de México, a '.$dd.' de '.$mm.' de '.$yyyy.'</p>
						<br>
						<b>Clave: '. $clave_colonia.' </b>
						<br>
						<b>Delegacion: '.$nombre_delegacion.'</b>
						<br>-->
						



						';
						

						// output the HTML content


						$html.= '<table border="1" style="min-width:80%; display:block; margin: 0 auto;">
						    <tr align ="center" bgcolor="#cccccc">
						        <th>N&uacute;m</th>
						        <th colspan="2">Asunto</th>
						        
						    </tr>';

						for($i=0;$i<sizeof($asuntos);$i++){
						$html.=
							'<tr >
								<td >'.($i+1).'</td>
								<td colspan="2">'.$asuntos[$i].'</td>
							</tr>';
								
						}


						$id_64=base64_encode($convocatoria_pdf);
						

						    
						      
						$html.='</table>


						

						<!-- <p><a href="'.URL_SISECOM.UPLOAD_DIR.$convocatoria_pdf.'">Descargar versión PDF</a></p>-->
						<p><a href="'.URL_SISECOM.'getfilepdf.php?f1='.$id_64.'">Descargar versión PDF</a></p>

						<p>Confirme firma y asistencia o ajustes en Convocatoria, a la cuenta de correo: '.$email_creador.'</p>



						<p>Esta notificación cumple el plazo establecido en el párrafo tercero del artículo 158 de la Ley de Participación Ciudadana, de al menos 5 días previos a la realización de la reunión. En caso de no contar con las confirmaciones de la mayoría del Pleno, la Convocatoria quedará sin efectos.</p>
						<hr>
						<div>
			                          <strong><p align="center"><font size="3pt">Instituto Electoral de la Ciudad de M&eacute;xico<br />
			                  Huizaches 25 &bull; Colonia   Rancho Los Colorines &bull; Alcald&iacute;a Tlalpan &bull; C.P.   14386 &bull; Ciudad de M&eacute;xico  &bull; Conmutador: (55) 5483 3800</font></p>
			                          </strong>
			            </div>';



						

						// output the HTML content
						



			}




			if($tipo_sesion_asamblea=='2'){
						$html.='<p align="center"><h1>Con fundamento en lo establecido en los artículos 81, 89, 93 y 143 de la Ley de Participación Ciudadana, pongo a su consideración la Convocatoria a Asamblea Ciudadana siguiente:</h1><p>
						<br>

						<p> Se llevará a cabo en: '.$domicilio.'</p>
						<p>Con fecha: '.$fecha.'</p>
						

						 <p>Con el siguiente orden del día:</p>

						

						
						<!--<b>Habitantes de la colonia '.$nombre_colonia.'</b>
						<p>Ciudad de México, a '.$dd.' de '.$mm.' de '.$yyyy.'</p>
						<br>
						<b>Clave: '. $clave_colonia.' </b>
						<br>
						<b>Delegacion: '.$nombre_delegacion.'</b>
						<br>-->
						



						';
						

						// output the HTML content


						$html.= '<table border="1" style="min-width:50%;">
						    <tr align ="center" bgcolor="#cccccc">
						        <th>N&uacute;m</th>
						        <th colspan="2">Asunto</th>
						        
						    </tr>';

						for($i=0;$i<sizeof($asuntos);$i++){
						$html.=
							'<tr >
								<td >'.($i+1).'</td>
								<td colspan="2">'.$asuntos[$i].'</td>
							</tr>';
								
						}
						   
						$id_64=base64_encode($convocatoria_pdf);
						      
						$html.='</table>


						<!--<p><a href="'.URL_SISECOM.UPLOAD_DIR.$convocatoria_pdf.'">Descargar versión PDF</a></p>-->

						<p><a href="'.URL_SISECOM.'getfilepdf.php?f1='.$id_64.'">Descargar versión PDF</a></p>

						<p>Confirme firma y asistencia o ajustes en Convocatoria, a la cuenta de correo: '.$email_creador.'</p>



						<p>Esta notificación cumple el plazo establecido en el artículo 90 de la Ley de Participación Ciudadana, de al menos 10 días previos a la realización de la reunión. En caso de no contar con las firmas definidas en el artículo 89 de la Ley de Participación, la Convocatoria quedará sin efectos</p>

						<hr>
						<div>
			                          <strong><p align="center"><font size="3pt">Instituto Electoral de la Ciudad de M&eacute;xico<br />
			                  Huizaches 25 &bull; Colonia   Rancho Los Colorines &bull; Alcald&iacute;a Tlalpan &bull; C.P.   14386 &bull; Ciudad de M&eacute;xico  &bull; Conmutador: (55) 5483 3800</font></p>
			                          </strong>
			            </div>';



						

						// output the HTML content
						



			}



							////////////////////////////////////////////////fin Cuerpo de corrreo




			$html.='</body> 
						</html>
						'; 
					//$body .= “Acá continuo el <strong>mensaje</strong>”;



			
					$mail = new PHPMailer(true);
					//Luego tenemos que iniciar la validación por SMTP:
					$mail->IsSMTP();
					$mail->CharSet = 'utf-8';
					$mail->SMTPAuth = false;
					$mail->Host = "145.0.40.63"; // SMTP a utilizar. Por ej. smtp.elserver.com
		//			$mail->Username = "inscripciones@iedf.org.mx"; // Correo completo a utilizar
		//			$mail->Password = "1nscr1pc10nes"; // Contraseña
		//			$mail->Port = 25; // Puerto a utilizar
					$mail->Username = "actividadesccycp@iecm.mx"; // Correo completo a utilizar
					$mail->Password = "s1s3c0m"; // Contraseña
					$mail->Port = 25; // Puerto a utilizar
					$mail->From = "actividadesccycp@iecm.mx"; // Desde donde enviamos (Para mostrar)
					$mail->FromName = "Instituto Electoral de la Ciudad de México";
					
					//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
					$destinatario1 = 'nancy.hernandez@iecm.mx';
					$destinatario2 = 'sergio.monterrubio@iecm.mx';	
					$destinatario3 = 'alejandra.arias@iecm.mx';

			$mail_errores=0;
			$mail_errores_msg="";
			$emails_enviados=array();

			//echo ".".$clave_colonia_conv.".";


			$query1= "SELECT email FROM sisecom_convocatorias_usuarios_comites where clave_colonia='".$clave_colonia_conv."'";




            $row1 = sqlsrv_query($conn,$query1);
            while($res1 = sqlsrv_fetch_array($row1))
            {
                    $email=$res1['email'];
                   
                    
                    //echo " /".$email."/ ";




                    if($email!=NULL){
                    	$emails_enviados[]=$email;

		                   try{
							$email="sergio.monterrubio@iecm.mx";

							$mail->AddAddress("sindy.medina@iedf.org.mx"); // Esta es la dirección a donde enviamos
							$mail->AddAddress($email);
							//$mail->AddAddress($destinatario2);// Esta es la dirección a donde enviamos
							//$mail->AddAddress($destinatario3);// Esta es la dirección a donde enviamos

					///////////////------>>>>>
							//$mail->AddCC("inscripciones@iedf.org.mx"); // Copia
							//$mail->AddBCC("inscripciones@iedf.org.mx"); // Copia oculta



							$mail->IsHTML(true); // El correo se envía como HTML
							$mail->Subject = "Sistema de registro de Convocatorias"; // Este es el titulo del email.
							$mail->Body = $html; // Mensaje a enviar
							
							$exito = $mail->Send(); // Envía el correo.
							

							//$exito ="1";//
							//$exito =0;//
				
								if($exito):
								//***Poner afuera*** Actualizamos la fecha de notificación (Si la librería no devuelve un valor, no se actualiza 
								//la fecha de notificación, por lo tanto se siguen mostrando en el sistema como pendientes, aunque si se hayan enviado)
								//Esto sucedió en casos de correos con dominio: comunidad.unam.mx, outlook.es, prodigy.net.mx
						//			$update_notifica = "UPDATE sei_registro SET fecha_notificacion = CURRENT WHERE folio = $folio;";
						//			ifx_query($update_notifica, $id_con);

									

		/*
									echo '<div class="alert alert-success alert-dismissible">Enviado
									<button type="button" class="close" data-dismiss="alert">&times;</button> 

									</div>';
		*/
									
									////////actualizar status
									


									////////////////////////status

								else:
									//	echo "Hubo un inconveniente. Intente más tarde.";
									
		/*
									echo '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button> 
									Mailer error: '.$mail->ErrorInfo.'</div>';
		*/
									

									/*$query2 = "UPDATE sisecom_convocatorias SET status='1' where id_convocatoria=".$id_convocatoria."";

								      $row2 = sqlsrv_query($conn,$query2);
								      if($row2)
								      {
								      	//echo '<div class="alert alert-success">Status FALLÓ</div>';

								      }else{
								        die( print_r( sqlsrv_errors(), true));
								      }*/

								      $mail_errores++;
								      $mail_errores_msg="Error: ".$mail->ErrorInfo;


								endif;
							}//try
							catch (Exception $e) {
									

								/*
								echo '<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert">&times;</button> Error al enviar el correo: '. $e->getMessage().'</div>';

									$query2 = "UPDATE sisecom_convocatorias SET status='1' where id_convocatoria=".$id_convocatoria."";

							      $row2 = sqlsrv_query($conn,$query2);
							      if($row2)
							      {
							      	//echo '<div class="alert alert-success">Status FALLÓ</div>';

							      }else{
							        die( print_r( sqlsrv_errors(), true));
							      }
									//echo '<div class="alert alert-danger">**</div>';
									*/
							      $mail_errores++;
							      $mail_errores_msg="Excepción: ".$e->getMessage();
							};//catch

                    }

                    $mail->ClearAddresses();
                    
                    

            }///////////////////////////////while de consulta en correos

            if($mail_errores==0){
            	echo '<div class="alert alert-success alert-dismissible">
							Correos enviados
							<button type="button" class="close" data-dismiss="alert">&times;</button> 

							</div>';

				echo '<div class="alert alert-success alert-dismissible">';
				echo '<p><b>Modo de prueba. Los correos deberían enviarse a las siguientes cuentas:</b></p>';

				for($i=0;$i<sizeof($emails_enviados);$i++){
					echo"<p>".ocultaremail($emails_enviados[$i])."</p>";
				}

				echo '<p><b>Modo de prueba. Sólo se enviaron a la cuenta:"'.$email.'"</b></p>';
							
				echo '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';


							/////////////////////bitacora
			                $ip_v4=$_SERVER['REMOTE_ADDR'];
			                
			                //$valor=sqlsrv_fetch_array( sqlsrv_query($conn,"SELECT IDENT_CURRENT ('sisecom_convocatorias') AS Current_Identity") );
			                //$ultimoregistro=$valor['Current_Identity'];

			                $queryB = "INSERT INTO sisecom_convocatorias_bitacora(usuario, ip,accion,texto,fecha) 
			                  values (".$tmpses_idusr.",'".$ip_v4."','publicarOK','id_".$id_convocatoria."','".date('Y-m-d H:i:s')."')";
			               
			                
			                $rowB = sqlsrv_query($conn,$queryB);
			                if($rowB)
			                {
			                  //echo "bitacora OK";

			                }else{

			                }
			                //////////////////////fin bitacora



            }else{
            	echo '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">&times;</button> Error al enviar uno o más correos. '.$mail_errores_msg.'</div>';

							$query2 = "UPDATE sisecom_convocatorias SET status='1' where id_convocatoria=".$id_convocatoria."";

					      $row2 = sqlsrv_query($conn,$query2);
					      if($row2)
					      {
					      	//echo '<div class="alert alert-success">Status FALLÓ</div>';

					      }else{
					        die( print_r( sqlsrv_errors(), true));
					      }

							/////////////////////bitacora
			                $ip_v4=$_SERVER['REMOTE_ADDR'];
			                
			                //$valor=sqlsrv_fetch_array( sqlsrv_query($conn,"SELECT IDENT_CURRENT ('sisecom_convocatorias') AS Current_Identity") );
			                //$ultimoregistro=$valor['Current_Identity'];

			                $queryB = "INSERT INTO sisecom_convocatorias_bitacora(usuario, ip,accion,texto,fecha) 
			                  values (".$tmpses_idusr.",'".$ip_v4."','publicarError','id_".$id_convocatoria."','".date('Y-m-d H:i:s')."')";
			               
			                
			                $rowB = sqlsrv_query($conn,$queryB);
			                if($rowB)
			                {
			                  //echo "bitacora OK y error";

			                }else{

			                }
			                //////////////////////fin bitacora

            }

            
						//$email; variable
		
	
?>