<?php

	//echo "guardarparticipante.php";
	include('sqlconnector.php');

	


	      $folio1=$_POST["folio1"];
	      $folio2=$_POST["folio2"];
	      $categoria=$_POST["categoria"];

	      $cat=array('0','A','B','C','D');
	      
	     
	      
	    //$enlace="maindistrito";



	    /* $queryCorreo="SELECT COUNT(idgrafiti) as repetido FROM participantes_grafiti where correo ='".$correo."'";

		  $row = sqlsrv_query($conn,$queryCorreo);
          if($res=sqlsrv_fetch_array($row))
          {
              
          	$repetido=intval($res['repetido']);
          	//echo "  **".$num."**  ";
          	if($repetido>=1){
          		echo " Correo ya registrado";
          		return;
          	}
          }else{

          	//echo "1"	;
            die( print_r( sqlsrv_errors(), true));
            ///echo '<a href="maindistrito.php" class="btn btn-primary">Haz clic aquí para continuar</a>';

          }
			*/

	    $query1="SELECT COUNT(DISTINCT sorteo) as numero FROM ".BD_PARTICIPANTES." where categoria=".$categoria." ";

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

          $grupo=$cat[$categoria].$num;
          $checkfolio=true;

         


         

	       


	   $query="UPDATE ".BD_PARTICIPANTES." set sorteo='".$grupo."',fecha_modifica='".date("Y-m-d h:i:sa")."' where folio='".$folio1."' ";

	    
		  $row = sqlsrv_query($conn,$query);
          if($row)
          {
              
          	
          	echo "OK1";
          
          	

          	
          }else{

          			
          
          
            die( print_r( sqlsrv_errors(), true));
           

          }

          $query="UPDATE ".BD_PARTICIPANTES." set sorteo='".$grupo."',fecha_modifica='".date("Y-m-d h:i:sa")."' where folio='".$folio2."' ";

	    
		  $row = sqlsrv_query($conn,$query);
          if($row)
          {
              
          	echo "OK2";

          
          	

          	
          }else{

          			
          
          
            die( print_r( sqlsrv_errors(), true));
           

          }

		//echo $query."  ////   ";

		//echo $query1."  ////   ";

		//echo $query2;

		//echo "     /".$correo_tutor."/    ";

		//echo "  //".$_POST["correo_tutor"]."//   ";


          echo  '<h5>Realizar sorteo</h5>
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
                          <input type="text" value="" id="folio1" >
                           
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
                          <input type="text" value="" id="folio2" >                           
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
                            <input type="text" value="" id="folio3" >                           
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
                        </div>
                      </div> <!-- trio -->

                      <hr>

                      <div class="row">
                        
                        <div class="col">
                          <a href="#" onclick="formarPareja();" class="btn btn-primary">Formar pareja</a>
                         
                          
                        </div>
                         <div class="col" id="formarparejamensaje"></div>
                        
                        

                      </div>
                   </div>';



    

?>