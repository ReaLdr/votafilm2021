<?php

 include('sqlconnector.php');

  session_start();
  //$concurso="debate";
  ///////////////////////////////////////////////////////sesión
  /*if(isset($_SESSION['idusuario'])){
     $idusuario=$_SESSION["idusuario"];
    $my_user=$_SESSION["usr"];
    $my_pwd=$_SESSION["pwd"];
    $area=$_SESSION["area"];
    $concurso=$area;
    $distrito=$_SESSION["distrito"];

      //$queryA="SELECT * FROM usuarios WHERE idusuario =".$idusuario." and usuario='".$my_user."' and area='".$area."'";
      $queryA="SELECT * FROM ".BD_USUARIOS." WHERE idusuario =".$idusuario." and perfil=2";

    //  echo $query;
      $resA=sqlsrv_query($conn,$queryA);
      if($rowA= sqlsrv_fetch_array($resA)){
       

      }else{
        session_destroy();
        header("location:index.php");
        
      }

 
    
  } else{
    
        session_destroy();
        header("location:index.php");
  }*/

 
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Concursos de divulgacion</title>
	
	
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
    <link rel="stylesheet" href="css/all.css">
	

	
</head>

<body>
	
	
	<!--

  <div class="container" id="topmenu">
    
    <div class="row">
      
      <div class="col-sm-8"></div>

      <div class="col-sm-2">
       
          <button class="btn" style="background-color: #FFF;">
          <?php 
			   //$completo = $mynombre.''.$mypaterno.''.$mymaterno;
            //echo $_SESSION["idusuario"]." / ";
            echo "Usuario: ".$my_user	;
            //echo $_SESSION["perfil"];
          ?>
          </button>
        
      </div>
      <div class="col-sm-1">
        <a href="logout.php" class="btn btn-secondary">Cerrar sesión</a>
      </div>
      
    </div>
  
  </div>-->
	
	
	
	   <?php //include('header.php');?>


    <div class="container" id="main_container">

      <h1>Sorteo debate</h1>
       <h3>Selecciona una categoría</h3>
     <div class="row">
                  <div class="col">
                    <a href="#" class="btn btn-primary btn-block" onclick="sorteocategoria(1)">
                    Categoría A  </a>
                   </div>
                   <div class="col">
                     <a href="#" class="btn btn-primary btn-block" onclick="sorteocategoria(2)">2  </a> 
                   </div>
                   <div class="col">
                    <a href="#" class="btn btn-primary btn-block" onclick="sorteocategoria(3)">3  </a>
                   </div>
                    <div class="col">
                    <a href="#" class="btn btn-primary btn-block" onclick="sorteocategoria(4)">4  </a>
                   </div>

                   <div class="col">
                     <a href="#" class="btn btn-primary btn-block">Exportar</a>
                   </div>
     
        <!-- <img src="img/<?php echo $concurso;?>.png">-->

     
     </div>
      
	   
     <div class="row">
      <input type="hidden" value="0" id="formcategoria" disabled>
      <h1 id="titulocategoria">-</h1>
       <div id="div_errors" class="btn btn-block"></div>
     </div>

      <div class="row">
                   <div class="col-sm-6 card p-10" id="s1">
                    <p>Sorteados</p>
                     
                   </div>
                   <div class="col-sm-6 card p-10" id="s2">
                    <h5>Realizar sorteo</h5>
                      <div class="row">
                        <div class="col"></div>
                        <div class="col">

                         <a href="#" class="btn btn-secondary btn-block" onclick="sorteoazar()" >Folios al azar</a>
                        </div>
                      </div>
                      <hr>


                      <div class="row">
                        
                        <div class="col">
                          <a href="#" class="btn btn-primary btn-block" onclick="sorteobuscarfolio(1)" >Buscar</a>
                          
                        </div>
                        <div class="col">
                          <input type="text" value="" id="folio1" disabled="true">
                           
                        </div>
                        

                      </div>
                      <div class="row alert alert-secondary">
                        <input type="hidden" value="0" id="idparticipante1" disabled>
                        
                          <div class="w-100">Nombre: <b><span id="res1"></span></b></div>
                         
                          <div class="w-100">Folio: <b><span id="res2"></span></b></div>
                         
                          <div class="w-100"><span id="res3"></span></div>
                      </div>

                      <hr>
                      
                      <div class="row">                        
                        <div class="col">
                          <a href="#" class="btn btn-primary btn-block" onclick="sorteobuscarfolio(2)" >Buscar</a>
                        </div>
                        <div class="col">
                          <input type="text" value="" id="folio2" disabled="true">                           
                        </div>
                      </div>

                      <div class="row alert alert-secondary">
                        <input type="hidden" value="0" id="idparticipante2" disabled>
                          <div class="w-100">Nombre: <b><span id="res4"></span></b></div>
                           
                          <div class="w-100">Folio: <b><span id="res5"></span></b></div>
                           
                          <div class="w-100"><span id="res6"></span></div>
                      </div>

                      <hr>
                      <button data-toggle="collapse" data-target="#div_trio">+</button>
                      
                      <div id="div_trio" class="collapse">
                        <div class="row">                        
                          <div class="col">
                            <a href="#" class="btn btn-primary btn-block" onclick="sorteobuscarfolio(3)" >Buscar</a>
                          </div>
                          <div class="col">
                            <input type="text" value="" id="folio3" disabled="true">                           
                          </div>
                        </div>

                        <div class="row alert alert-secondary">
                          <input type="hidden" value="0" id="idparticipante3" disabled>
                            <div class="w-100">Nombre: <b><span id="res7"></span></b></div>
                             
                            <div class="w-100">Folio: <b><span id="res8"></span></b></div>
                             
                            <div class="w-100"><span id="res9"></span></div>
                        </div>

                        <div class="row">

                          <div class="col">
                            <a href="#" onclick="formarTrio();" class="btn btn-primary">Formar trío</a>
                          </div>
                           <div class="col" id="formartriomensaje"></div>
                        </div>
                      </div> <!-- trio -->

                      <hr>

                      <div class="row">
                        
                        <div class="col">
                          <a href="#" onclick="formarPareja();" class="btn btn-primary">Formar pareja</a>
                         
                          
                        </div>
                         <div class="col" id="formarparejamensaje"></div>
                        
                        

                      </div>
                   </div><!--s2-->
    </div>
              
                

                              

              
			
	       
			
			    
			
	   </div> <!--- cierra  conteiner  -->
   <?php include('footer.php');?>
</body>
</html>
