<?php
	//session_start();
  if(!isset($_POST['concurso'])){
    //header("Location: index.php");

  }

  function close_system(){
    header('Location: login.php');
    exit;
  }

  $fecha1="2021-08-20 12:00:00";//LA BUENA
  $fecha2="2021-11-30 23:59:59";
  if(date("Y-m-d H:i:s")>=date($fecha1)&&date("Y-m-d H:i:s")<=date($fecha2)){
    //echo "dentro de rango";
    //$fecha_registro="";
    //Se pueden registrar
  }else{
    //echo "fuera de rango";
    close_system();
     //$fecha1="-";
    //$fecha2="-";
  }
  ///////////////////////////////////////////////////////sesión
  /*if(isset($_SESSION['idusuario'])){

    $my_user=$_SESSION["usr"];
    $my_pwd=$_SESSION["pwd"];



  } else{

        session_destroy();
        header("location:index.php");
  }*/

	include('phpmailer/class.phpmailer.php');
	include('phpmailer/class.smtp.php');
	include('phpmailer/PHPMailerAutoload.php');
  	include('sqlconnector.php');
	//define("URL_CONCU", "https://aplicaciones.iecm.mx/concursos2019/");
	include('rutasitio.php');

	$message="";
	$action = "";
	$pass1 = "";
	$count_usuario = "";

	$concurso="xxx";


  if(isset($_POST['action'])){

  	$action=$_POST['action'];


  	$nombre=$_POST['nombre'];

	$paterno=$_POST['paterno'];

	$materno=$_POST['materno'];



  	$user=$_POST['user'];
	$correo=$_POST['correo'];

	//$genero=$_POST['genero'];
	$fecha_nacimiento=$_POST['fecha_nacimiento'];

			//$sql_usuario = "SELECT COUNT(*) AS existe FROM q_usuarios WHERE usuario = '$user';";
			//$sql_usuario = "SELECT COUNT(usuario) AS existe_usuario, COUNT (correo) AS existe_correo FROM q_usuarios WHERE usuario = '$user' and correo = '$correo' group by usuario, correo; ";
			$sql_usuario = "SELECT * FROM ".BD_USUARIOS." WHERE usuario = '$user' or correo = '$correo';";
			//echo $sql_usuario;
				$res_count = sqlsrv_query($conn, $sql_usuario);
				//$row_count = sqlsrv_fetch_array($res_count);

				//$count_usuario = 0;
				//$count_usuario = $row_count['existe_usuario'];

				while($row = sqlsrv_fetch_array($res_count)){
				//Validadion usuario y correo

					if ($user==$row["usuario"]){
						$action = "";
						echo "1";

					}

					if ($correo==$row["correo"]){
						$action = "";
						echo "2";
					}
				}



//
  	//$area=$_POST['area'];
  	$pass1=$_POST['pass1'];




  if($action=="insert"){


	//$query= "INSERT INTO ".BD_USUARIOS." (nombre, paterno, materno, area, genero, fecha_nacimiento, correo, usuario, contrasena, perfil, estatus, fecha_alta) VALUES ('".$nombre."','".$paterno."','".$materno."','".$area."','".$genero."','".$fecha_nacimiento."','".$correo."','".$user."','".$pass1."','1','1','".date("Y-m-d h:i:sa")."')";

  	$query= "INSERT INTO ".BD_USUARIOS." (nombre, paterno, materno, fecha_nacimiento, correo, usuario, contrasena, perfil, estatus, fecha_alta) VALUES
  									('".$nombre."','".$paterno."','".$materno."','".$fecha_nacimiento."','".$correo."','".$user."','".$pass1."','1','1','".date("Y-m-d h:i:sa")."')";


	//echo $query;
  	$row=sqlsrv_query($conn,$query);



	$query2= "SELECT SCOPE_IDENTITY() AS ultimo from ".BD_USUARIOS." ";
	$row2=sqlsrv_query($conn,$query2);

	if($res2=sqlsrv_fetch_array($row2)){
		$idusr=$res2["ultimo"];

		//echo "// ".$idusr." //   ";
	}

	$query3= "SELECT * from ".BD_USUARIOS." where idusuario=".$idusr."";
	$row3=sqlsrv_query($conn,$query3);

	while($res3=sqlsrv_fetch_array($row3)){
		$nombre_c = $res3['nombre'];
		$paterno_c= $res3['paterno'];
		$materno_c = $res3['materno'];
		$user_c= $res3['usuario'];
		$pass1=$res3['contrasena'];

		$email= $res3['correo'];
	}


	///$row=false;

		//////crear correooooo/////



	if($row){

		$usuario_creado=true;


		echo '<div class="row">
					<div class="col-sm-8"></div>
					<div class="col-sm-4">
				      <a href="index.php" class="btn btn-secondary">Regresar</a>
				    </div>
			    </div>';

		echo "<div class='alert alert-success' align='center'> <p>Usuario creado correctamente.</p></div>";


		echo "<div class='row'>";
		echo "<div class='col-sm-12' align='center' id='divcorreo'><p>¿No has recibido ningún correo?</p> <button class='btn btn-primary' onclick='fnReenviarCorreo(".$idusr."); this.disabled=true;'>Haz clic aquí para enviarlo otra vez</button></div>";
		echo "</div>";




	}else{

		$usuario_creado=false;

		echo "<div class='alert alert-danger' align='center'>Error al crear el usuario</div>";
		echo '<div class="col-sm-4">
			      <a href="index.php" class="btn btn-secondary">Regresar</a>
			    </div>';


	}


	if($usuario_creado){




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
						      	<td width="805"><h1 style="color:#6611AA;">Vota<b>filmfest</b> 2021</h1> </td>
				    		</tr>
			  			</tbody>
					</table>
					<hr>

					<div style="align:center">


							<p align="justify"><h3>Estimado(a) '.$nombre_c.' '.$paterno_c.' '.$materno_c.'.</h3></p>

							<p align="justify"> Agradecemos tu registro de usuario para la cuarta edición del Concurso de Cortos VOTA FILM FEST 2021 del Instituto Electoral de la Ciudad de México. Para continuar con tu inscripción como participante, deberás ingresar al sistema con tu usuario y contraseña.</p>
							<p align="justify">Es importante que, previo a tu solicitud de registro como aspirante, cuentes con toda la información y documentación necesaria señalada en la Convocatoria, ya que tu registro depende de ello.</p>
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
					                  Huizaches 25 &bull;  Rancho Los Colorines &bull; Tlalpan &bull; C.P.   14386 &bull; Ciudad de M&eacute;xico  &bull; Conmutador: (55) 5483 3800</font></p>
					                          </strong>
					        </div>
					</body>
					</html>';

		                   try{




							$mail->AddAddress($email);


							///////////////------>>>>>
							//$mail->AddCC("inscripciones@iedf.org.mx"); // Copia


							$mail->AddBCC("daniel.rea@iecm.mx"); // Copia oculta




							$mail->IsHTML(true); // El correo se envía como HTML
							$mail->Subject = "VOTAFILMFEST"; // Este es el titulo del email.
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


	}






  } /// cierre accion insert



}else{



?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>votafilmfest</title>

	 <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mycss.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--<script src="js/holder.min.js"></script>-->
    <script src="js/funcionesajax.js"></script>


</head>
<body>

<?php
		include('header.php');

?>

<div class="container" id="main_container">

	<div class="form-group row">

			    <div class="col-sm-10">

			    </div>

			    <div class="col-sm-2">
			      <a href="index.php" class="btn btn-secondary">Regresar</a>
			    </div>

		   </div>
	<div style="margin: 0 auto; width:80%;">

		<p>La información que se capture a partir de este momento deberá corresponder con los datos de quien vaya a participar.</p>
		<p>Si eres madre, padre, tutora o tutor de una persona menor de edad deberás capturar los datos de la persona menor de edad.</p>
		<p>Llena los siguientes campos para generar usuario y contraseña para el registro:</p>

</p>


	</div>
    <div class="card">
      <div class="card-header"><b>Nuevo registro</b></div>
      <div class="card-body">
          <!-- ////////////////////////////////////////////////////////////// -->

         <!-- <div class="form-group row">
		    <label class="col-sm-3 control-label">Tipo de concurso</label>
		    <div class="col-sm-9">
		      <select id="sel" name="sel" class="form-control" disabled>
		      	<option value="0" selected >votafilmfest</option>


		      </select>
		    </div>

		   </div>
		   <hr>-->




			<div class="form-group row">
				<input type="hidden" value="<?php echo $idusr?>" id="iduser" name="iduser">


			    <label class="col-sm-3 control-label">Nombre</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" >
			    </div>
			</div>

			<div class="form-group row">
			    <label class="col-sm-3 control-label">Primer apellido</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="paterno" name="paterno" placeholder="Primer apellido" >
			    		</div>
			</div>

			<div class="form-group row">
				    <label class="col-sm-3 control-label">Segundo apellido</label>
				    <div class="col-sm-4">
				      <input type="text" class="form-control" id="materno" name="materno" placeholder="Segundo apellido" >
				    </div>


			</div>


			<div class="form-group row" style="display: none;">

		        <label class="col-sm-3 control-label">Género</label>
		        <div class="col-sm-6">
		            <select  class="form-control input-medium" name="genero" id="genero" >
			            <option value="0" selected disabled>Selecciona una opción</option>
			            <option value="M" >Masculino</option>
			            <option value="F" >Femenino</option>
			            <option value="X" >Sin identificar</option>
					</select>
		        </div>
			</div>

			<div class="form-group row" >

		        <label class="col-sm-3 control-label">Fecha de nacimiento</label>
		        <div class="col-sm-3">
		            <input class="form-control input-small" type="date" name="fecha_nacimiento" id="fecha_nacimiento" onchange="fnEdad();" step='1' min='1990-01-01' max='2010-09-18' value="2007-00-00" required>

		            <input type="hidden" name="edad_califica" id="edad_califica" value="0">
		            <input type="hidden" name="edad" id="edad" value="0">



		        </div>
		        <div class="col-sm" id="erroredad"></div>
			</div>

			<div class="form-group row" >

		        <label class="col-sm-3 control-label">Categoría</label>
			       <div class="col-sm-6">
			            <select  class="form-control input-medium" name="categoria" id="categoria"  disabled>
				            <option value="0" selected disabled>Selecciona una opción</option>
				            <option value="1" >12 a 17 años</option>
				            <option value="2" >18 a 29 años</option>



						</select>
			        </div>

			</div>







	<hr>

		  <div class="form-group row">
		    <label class="col-sm-3 control-label">Nombre de usuario</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="user" name="user" placeholder="Nombre de usuario sin espacios" onkeypress="return validar2(event)" maxlength="20">
		    </div>

		   </div>

		   <div class="form-group row">
		    <label class="col-sm-3 control-label">Contraseña</label>
		    <div class="col-sm-9">
		      <input type="password" class="form-control" id="pass1" placeholder="Contraseña" onkeypress="return validar2(event)" maxlength="20">
		    </div>

		   </div>

		   <div class="form-group row">
		    <label class="col-sm-3 control-label">Repetir contraseña</label>
		    <div class="col-sm-9">
		      <input type="password" class="form-control" id="pass2" placeholder="Repetir la contraseña" onkeypress="return validar2(event)" onpaste="return false;">
		    </div>

		   </div>





	   <hr>

		   <div class="form-group row">
		    <label class="col-sm-3 control-label">Correo electrónico</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" >
		    </div>

		   </div>

		   <div class="form-group row">
		    <label class="col-sm-3 control-label">Repetir correo electrónico</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control" id="correo2" name="correo2" placeholder="Repetir correo electrónico" onpaste="return false;">

		    </div>
		   </div>
	   <hr>

		<div class="form-group row">
		    <div class="col-sm-4">
			    <input class="form-control" id="tmptxt" name="tmptxt" type="text" placeholder="Escribe los caracteres de la imagen" autocomplete="off">
				<input class="form-control" id="tmptxt2" name="tmptxt2" type="hidden" value= "<?php $_SESSION['tmptxt2']?>" autocomplete="off">
				</br>
		          	  <img src="captcha.php" width="137" height="50">
			</div>
			<div class="col-sm-4">
					   <input class="btn btn-secondary"  name="button" type="button" onClick="save_temp();history.go(0)" value="Nuevos caracteres">
			</div>
		</div>






       <hr>
		   <div class="form-group row">

			    <div class="col-sm-6">
			      <button class="btn btn-primary btn-block" id="btn_crearusuario" onclick="this.disabled=true;crearusuario();">Crear cuenta de usuario</button>
			    </div>

			    <div class="col-sm-4">
			      <a href="index.php" class="btn btn-secondary">Regresar</a>
			    </div>

		   </div>
		   <div class="row">
		   		<div id="errormsg"></div>
		   </div>







  		</div> <!-- panel body -->
	</div>
</div> <!--- maincontainer -->

<script type="text/javascript">
  function save_temp(){
    sessionStorage.setItem('nombre_ss', document.getElementById('nombre').value);
    sessionStorage.setItem('paterno_ss', document.getElementById('paterno').value);
    sessionStorage.setItem('materno_ss', document.getElementById('materno').value);
    sessionStorage.setItem('fecha_nacimiento_ss', document.getElementById('fecha_nacimiento').value);
    sessionStorage.setItem('edad_califica_ss', document.getElementById('edad_califica').value);
    sessionStorage.setItem('edad_ss', document.getElementById('edad').value);
    sessionStorage.setItem('categoria_ss', document.getElementById('categoria').value);
    sessionStorage.setItem('user_ss', document.getElementById('user').value);
    sessionStorage.setItem('pass1_ss', document.getElementById('pass1').value);
    sessionStorage.setItem('pass2_ss', document.getElementById('pass2').value);
    sessionStorage.setItem('correo_ss', document.getElementById('correo').value);
    sessionStorage.setItem('correo2_ss', document.getElementById('correo2').value);
  }

  function read_data(){
    document.getElementById('nombre').value = sessionStorage.getItem('nombre_ss'),
    document.getElementById('paterno').value = sessionStorage.getItem('paterno_ss'),
    document.getElementById('materno').value = sessionStorage.getItem('materno_ss'),
    document.getElementById('fecha_nacimiento').value = sessionStorage.getItem('fecha_nacimiento_ss'),
    document.getElementById('edad_califica').value = sessionStorage.getItem('edad_califica_ss'),
    document.getElementById('edad').value = sessionStorage.getItem('edad_ss'),
    document.getElementById('categoria').value = sessionStorage.getItem('categoria_ss'),
    document.getElementById('user').value = sessionStorage.getItem('user_ss'),
    document.getElementById('pass1').value = sessionStorage.getItem('pass1_ss'),
    document.getElementById('pass2').value = sessionStorage.getItem('pass2_ss'),
    document.getElementById('correo').value = sessionStorage.getItem('correo_ss'),
    document.getElementById('correo2').value = sessionStorage.getItem('correo2_ss');
    sessionStorage.clear();
  }

  read_data();

</script>
<?php
	include('footer.php');
?>


</body>
</html>

<?php


	} ////fin del else


  ?>
