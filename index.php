<?php
  //header("Location: ../index.php");


?>

<!doctype html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="pragma" content="no-cache" />


  <title>VOTAFILMFEST 2021</title>


  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/mycss.css?random=<?php echo rand() ?>" rel="stylesheet">


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script src="js/funcionesajax.js?random=<?php echo rand() ?>"></script>
  <link rel="stylesheet" href="css/all.css?random=<?php echo rand() ?>">
  <link rel="stylesheet" href="css/animate.min.css?random=<?php echo rand() ?>">

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"/> -->


<style media="screen">
@import url('https://fonts.googleapis.com/css?family=Lobster+Two');
 h1 {
	 font-family: 'Lobster Two', cursive;
	 font-size: 2rem;
	 /* text-shadow: 0px 1px 0px rgba(255, 255, 255, 1); */
	 /* color: #343434; */
}
 .animacion_index {
	 position: relative;
	 z-index: 0;
	 /* background-color: #ededed; */
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 /* min-height: 100vh; */
	 overflow: hidden;
}
 .pulse {
	 z-index: -1;
	 position: absolute;
	 top: 50%;
	 left: 50%;
	 transform: translate(-50%, -50%);
	 max-width: 5rem;
}
 .pulse circle {
	 fill: #ff5154;
	 transform: scale(0);
	 opacity: 0;
	 transform-origin: 50% 50%;
	 animation: pulse 2s cubic-bezier(0.5, 0.5, 0, 1);
}
 .pulse circle:nth-child(2) {
	 fill: #7fc6a4;
	 animation: pulse 2s 0.75s cubic-bezier(0.5, 0.5, 0, 1);
}
 .pulse circle:nth-child(3) {
	 fill: #e5f77d;
	 animation: pulse 2s 1.5s cubic-bezier(0.5, 0.5, 0, 1);
}
 @keyframes pulse {
	 25% {
		 opacity: 0.4;
	}
	 100% {
		 transform: scale(1);
	}
}

.animate__animated {
    -webkit-animation-duration: 1s !important;
    animation-duration: 1s !important;
    -webkit-animation-duration: 1s !important;
    animation-duration: 1s !important;
    -webkit-animation-fill-mode: both !important;
    animation-fill-mode: both !important;
}
</style>



</head>

<body class="">

  <?php
      include("header.php");
    ?>

  <div class="container">

    <div class="container" id="main_container">

      <div class="animacion_index">

        <h1 style="padding: 14px; display: flex;" class="indicacion animated bounceIn">Da click en la imagen para el registro <i class="fas fa-arrow-down"></i></h1>

        <svg class="pulse" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <circle id="Oval" cx="512" cy="512" r="512"></circle>
          <circle id="Oval" cx="512" cy="512" r="512"></circle>
          <circle id="Oval" cx="512" cy="512" r="512"></circle>
        </svg>

      </div>

      <div class="row justify-content-md-center">
        <div class="col-sm-auto contenido indicacion animated bounceIn">



          <button class="btn btn-portada"><img src="img/logovota2021.png?random=<?php echo rand() ?>" class="img-fluid">

            <div class="overlay">
              <div class="text">¡Regístrate!</div>
            </div>
          </button>




        </div>

      </div>

      <script type="text/javascript">
      $(document).ready(function(){
      setTimeout(function(){ $( ".btn-portada" ).effect( "shake" ); }, 3000);
      setInterval(function(){ $( ".fa-arrow-down" ).effect( "bounce" ); }, 2500);
      // setInterval(function(){ $( ".btn-portada" ).effect( "shake" ); }, 3000);
      $( ".btn-portada" ).click(function() {
        $(".indicacion").removeClass("bounceIn");
        $(".indicacion").addClass("bounceOut");
        //Quitamos texto y 1 segundo después vamos a la pagina
        //setTimeout(function({window.location.href = 'login.php';},1500));
        setTimeout(function(){
          window.location.href = 'login.php'
        }, 1200);
      });
      });
      </script>








    </div>
  </div>


  <?php
      include("footer.php");
    ?>
</body>

</html>
