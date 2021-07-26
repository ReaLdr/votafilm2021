<?php
	
include 'sqlconnector.php';
session_start();
$idusuario=$_SESSION["idusuario"];
	
error_reporting(0);

	
$accion=$_POST['accion'];

 $val= $_POST['val'];
	

	//echo "accion en la que entroooo  ". $accion;
	
	
  if($accion=="folio"){ /////apellido paterno


		$query= "SELECT A.*,B.fecha_nacimiento, B.usuario, B.iddistrito FROM ".BD_PARTICIPANTES." as A INNER JOIN ".BD_USUARIOS." as B ON A.idusuario= B.idusuario where ( UPPER(A.paterno) like UPPER('%".$val."%')) ";
     	 
	/* $query ="SELECT * FROM  participantes_grafiti where folio like '%$val%' ";*/

  }


  if($accion=="nombre"){

    
	  
	 	$query= "SELECT A.*,B.fecha_nacimiento, B.usuario FROM ".BD_PARTICIPANTES." as A INNER JOIN ".BD_USUARIOS." as B ON A.idusuario= B.idusuario where ( UPPER(A.nombre) like UPPER('%".$val."%')) "; 
 		//$query ="SELECT * FROM  participantes_grafiti where sobrenombre like '%$val%' ";
	  	

  }

  if($accion=="distrito"){


     $query =" SELECT A.*,B.fecha_nacimiento, B.usuario, B.fecha_alta as fecha_registro FROM ".BD_PARTICIPANTES." as A INNER JOIN ".BD_USUARIOS." as B ON A.idusuario= B.idusuario and B.iddistrito = $val ";


  }

   

    //echo " * ".$query." * ";
echo '<hr>';

 echo '<div class="grouprowconsultas">';
    	echo '<div class="row headerconsultas">
        			<div class="col-sm-4">
        				Nombre 
        			</div>
        			<div class="col-sm-2">
        				Folio
        			</div>
        			<div class="col-sm-2">
        				Documento
        			</div>
      				<div class="col-sm-4">
          				Usuario que realizó la validación
          		</div>
		
    		  </div>';
	 
   
   	 

 // $query="SELECT A.*,B.fecha_nacimiento, B.usuario FROM participantes_grafiti as A LEFT JOIN usuarios as B ON A.idusuario= B.idusuario WHERE A.idusuario =".$idusuario."";
 // $query="SELECT A.*,B.fecha_nacimiento, B.usuario FROM participantes_grafiti as A LEFT JOIN usuarios as B ON A.idusuario= B.idusuario ";

//  echo $query;

    $res=sqlsrv_query($conn,$query);
    
 //if($row= sqlsrv_fetch_array($res)){
	 while($row= sqlsrv_fetch_array($res))
	 {

    	
		$nombre_completo=$row["nombre"].' '.$row["paterno"].' '.$row["materno"];

    

		$folio= $row["folio"];
		$usuario= $row["usuario"];
		$id=$row["id"];
    $categoria=$row["categoria"];
    
		 
    

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

       

    	
      $status_requisitos=$row["status_requisitos"]; ///guardé usuario de la session como usuario que hace la evaluación
      $validador=$row["validador"];


      $fecha_nacimiento=$row["fecha_nacimiento"];
    
      $fecha_alta=$row["fecha_alta"];
    //$años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
      $edad=date_diff(date_create($fecha_nacimiento), date_create($fecha_alta))->y;


   
   	
 
    	echo '<div class="row rowconsultas">
        			<div class="col-sm-4">
        				'.$nombre_completo.'
        			</div>


          			<div class="col-sm-2">';
          			//if($ensayo)
          				//echo '<a href="'.UPLOAD_DIR.$ensayo.'"><i class="fas fa-cube"></i></a>';
      					echo $folio;
          		//	else
          				//echo '-';

          	     echo   '</div>
		
          <div class="col-sm-2">';
      				if ($status_requisitos == 3){

               
                   //echo '<a href="#" class="btn btn-success" onclick="fnValidar('.$id.','.$categoria.','.$pais.')">VALIDADO</a>';
                echo '<p class="badge badge-success">VALIDADO</a>';
                }else{

                  if($status_requisitos==0){
                    echo '<a href="#" class="btn btn-light" >Sin documentos</a>';

                  }else{
                    echo '<a href="#" class="btn btn-primary" onclick="fnValidar('.$id.','.$categoria.','.$pais.')">POR VALIDAR</a>';

                  }
                  
                     
                  

                }
                
                  

             
				
    				
    		echo'</div>
    			
    			<div class="col-sm-4">';

          $usuario_validador= array(1 => "admin1",2 => "admin2",3 =>"central3", 5 =>"user5-" );
    				
            //$usuario_validador= array(1=>"admin1", 2=>"admin2",3=>"admin3",34 => "central1",35 => "central2", 36=>"central3");
              echo $usuario_validador[intval($validador)];


        echo '</div>
				
				
    		  </div>';///row
	 
   


  	

 }// cierra el do while 
  echo '</div>';  ///grouprowconsultas
	 
	 
   /////// aqui quite cosas////

   	echo '<div id="errormsg"></div>';




  
	
?>