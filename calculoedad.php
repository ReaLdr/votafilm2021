<?php
   // $fecha_nacimiento="1989-09-07"; ///

   // $fecha_nacimiento="2007-09-06"; ///


    $fecha_nacimiento=$_POST['fecha_nacimiento'];


//    $fecha_inicio_año_concurso="2020-01-01";

    $fecha_inicio_concurso="2021-07-27";
    //$fecha_inicio_concurso="2021-08-10";//ORIGINAL


//    $fecha_fin_año_concurso="2020-12-31";



    $años_hoy=date_diff(date_create($fecha_nacimiento), date_create('today'))->y;

    $años_inicio=date_diff(date_create($fecha_nacimiento), date_create($fecha_inicio_concurso))->y;
  //  $años_fin=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_concurso))->y;


//    $años_fin_año=date_diff(date_create($fecha_nacimiento), date_create($fecha_fin_año_concurso))->y;

//    $años_inicio_año=date_diff(date_create($fecha_nacimiento), date_create($fecha_inicio_año_concurso))->y;

/*
    $cadena_edad= "<p> / ".$fecha_nacimiento." / <p>
    <p>  años hoy: ".$años_hoy."/ </p>
    <p>  edad al inicio del año: ".$años_inicio_año."/ </p>
    <p>**edad al inicio del concurso: ".$años_inicio."/ </p>
    <p>  edad al fin del concurso: ".$años_fin."/ </p>
    <p>  edad al fin del año: ".$años_fin_año."/ </p>";
*/
    //echo $cadena_edad;
    $cadena_edad="";

   $califica=false;




    if($años_inicio>=12&&$años_inicio<=29){
    	//echo "Califica. ";
        $califica=true;

    	//if($años_inicio<=29&&$años_fin<=29&&$años_inicio>=18) //echo "Tendría la edad adecuada durante el concurso. ";
    	//if($años_inicio<=29&&$años_fin>29) //echo "Tendría la edad adecuada sólo al inicio. ";

    }

    if($años_inicio==30||$años_inicio==31||$años_inicio==11){
       // $califica=true;
    }





   $edad=$años_inicio;

        if($califica){

            $resultado=array(
                        'edad'=>$edad,
                        'mensaje'=>'<div class="alert alert-success">Tu edad (al 10 de agosto de 2021): <b>'.$edad.'</b> '.$cadena_edad.'</div>',
                        'califica'=>'1'
                        );

            /*
            $resultado='{
                        "edad":"'.$años_hoy.'",
                        "mensaje": "Tienes la edad adecuada para participar en el concurso",
                        "califica": "1"
                        }';
            */
/*
        echo "<p>Tu edad al día de hoy: ".$años_hoy." </p>";
        echo '<div class="alert alert-success"> Tienes la edad adecuada para participar en el concurso
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>

              </div>'; */

        }else{


             $resultado=array(
                        'edad'=>$edad,
                        'mensaje'=>'<div class="alert alert-warning"><p>Tu edad (al 10 de agosto de 2021):<b>'.$edad.'</b></p><p>Sólo se permite concursar en dos categorías: de 12 a 17 años y de 18 a 29 años.</p>'.$cadena_edad.'</div>',
                        'califica'=>'0'
                        );
             /*
            $resultado='{
                        "edad":"'.$años_hoy.'",
                        "mensaje": "En su base 4, la convocatoria señala que podrán participar personas jóvenes que tengan entre 18 y 29 años, esto incluye personas que durante el año del concurso vayan a cumplir la mayoría de edad. Igualmente, si durante el desarrollo del certamen la o el participante sobrepasa la edad máxima requerida podrá seguir participando.",
                        "califica": "0"
                        }';
            */

/*
            echo "<p>Tu edad al día de hoy: ".$años_hoy." </p>";
            echo '<div class="alert alert-warning"> En su base 4, la convocatoria señala que podrán participar personas jóvenes que tengan entre 18 y 29 años, esto incluye personas que durante el año del concurso vayan a cumplir la mayoría de edad. Igualmente, si durante el desarrollo del certamen la o el participante sobrepasa la edad máxima requerida podrá seguir participando.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>

                  </div>'; */

        }

        echo json_encode($resultado);




?>
