<?php

	include('phpmailer/class.phpmailer.php');
	include('phpmailer/class.smtp.php');
	include('phpmailer/PHPMailerAutoload.php');
  	include('sqlconnector.php');
	//define("URL_CONCU", "http://145.0.40.76/concursos2019/");
	include('rutasitio.php');
	
	  
	

  	$idusr=$_POST['id'];

  	$correo=$_POST['correo'];




	if($idusr==0){
		$query3= "SELECT * from ".BD_USUARIOS." where correo='".$correo."'";
		$row3=sqlsrv_query($conn,$query3);
		
		while($res3=sqlsrv_fetch_array($row3)){

			$idusr = $res3['idusuario'];
			$nombre_c = $res3['nombre'];
			$paterno_c= $res3['paterno'];
			$materno_c = $res3['materno'];
			$user_c= $res3['usuario'];
			$pass1=$res3['contrasena'];

			$correo= $res3['correo'];
		}

	}else{
		$query3= "SELECT * from ".BD_USUARIOS." where idusuario=".$idusr."";
		$row3=sqlsrv_query($conn,$query3);
		
		while($res3=sqlsrv_fetch_array($row3)){
			$nombre_c = $res3['nombre'];
			$paterno_c= $res3['paterno'];
			$materno_c = $res3['materno'];
			$user_c= $res3['usuario'];

			$correo= $res3['correo'];
			$pass1=$res3['contrasena'];
		}

	}

	
		

	///$row=false;
		
		//////crear correooooo/////
		
		

	

		
		
	if($row3 &&$correo!=""){
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
					$mail->From = "no-reply@iecm.mx"; // Desde donde enviamos (Para mostrar)
					$mail->FromName = "Instituto Electoral de la Ciudad de México";
					
					//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
					
				
			
					$id_64=base64_encode($idusr);
				

	
					$html=' 
					<html>
					<body style="width:80%; display: block; margin: 0 auto;">
					<table width="353" border="0">
			  			<tbody>
				    		<tr>
				      			<td width="218"><img src="'.URL_CONCU.'/img/header20_1.png" width="146" height="151"></td>
						      	<td width="805"><h1 style="color:#6611AA;">VOTA<b>FILM</b>FEST 2020</h1> </td>
				    		</tr>
			  			</tbody>
					</table>
					<hr>

					<div style="align:center">
							
							
							<p align="justify"> Agradecemos tu registro de usuario para la tercera edición del Concurso de Cortos Vota Film Fest 2020 del Instituto Electoral de la Ciudad de México. Para continuar con tu inscripción como participante, deberás ingresar al sistema con tu usuario y contraseña.</p>
							<p align="justify">Es importante que previo a tu solicitud de registro como aspirante, cuentes con toda la información y documentación necesaria señalada en la Convocatoria, ya que tu registro depende de ello.</p>
							<br>
							<br>

							<!--<p>Primero, para activar tu cuenta <strong><a href="'.URL_CONCU.'confirma.php?f1='.$id_64.'"> haz clic aquí. </a><strong></p>-->

							<p>Inicia sesión <a href="'.URL_CONCU.'index.php"> haciendo clic aquí</a></p>

							<div style="display:block; margin:0 auto; text-align:center; max-width: 70%; border:1px solid #EEE;">
								<p> Tu usuario y contraseña son: </p>
								<p> Usuario: <strong>'.$user_c.'</strong></p>
								<p> Contraseña: <strong>'.$pass1.'<strong></p>
							</div>
							<hr>
							<div>
					            <strong><p align="center"><font size="3pt">Instituto Electoral de la Ciudad de M&eacute;xico<br />
					                  Huizaches 25 &bull; Colonia   Rancho Los Colorines &bull; Tlalpan &bull; C.P.   14386 &bull; Ciudad de M&eacute;xico  &bull; Conmutador: (55) 5483 3800</font></p>
					                          </strong>
					        </div>
					</body>
					</html>';

		                   try{
							$destinatario1 = 'nancy.hernandez@iecm.mx';
							$destinatario2 = 'sergio.monterrubio@iecm.mx';	
				

							//$mail->AddAddress($destinatario1); // Esta es la dirección a donde enviamos
							//$mail->AddAddress($destinatario2); // Esta es la dirección a donde enviamos
							$mail->AddAddress($correo);
							//$mail->AddAddress($destinatario2);// Esta es la dirección a donde enviamos
							//$mail->AddAddress($destinatario3);// Esta es la dirección a donde enviamos

							///////////////------>>>>>
							//$mail->AddCC("inscripciones@iedf.org.mx"); // Copia
							//$mail->AddBCC("inscripciones@iedf.org.mx"); // Copia oculta
							$mail->AddBCC("sergio.monterrubio@iecm.mx"); // Copia oculta
							//$mail->AddBCC("concursos@iecm.mx"); // Copia oculta


							$mail->IsHTML(true); // El correo se envía como HTML
							$mail->Subject = "REENVÍO - VOTAFILMFEST"; // Este es el titulo del email.
							$mail->Body = $html; // Mensaje a enviar
							
							$exito = $mail->Send(); // Envía el correo.
							

							//$exito ="1";//
							//$exito =0;//
				
								if($exito):

									echo "<div class='alert alert-success'>Correo enviado</div>";


								else:

									echo "<div class='alert alert-warning'>Hubo un problema con el formato del correo electrónico</div>";
	

								 


								endif;
							}//try
							catch (Exception $e) {
					
							      echo "<div class='alert alert-warning'> Erro al enviar el correo. Excepción: ".$e->getMessage()."</div>";
							};//catch

                    

                    $mail->ClearAddresses();

                     

    }


     ///echo " - id=".$idusr." - correo: ".$correo;


   
                    

	






  
  ?>
