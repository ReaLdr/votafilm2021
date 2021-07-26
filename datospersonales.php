<?php

//include 'sqlconnector.php';
 //session_start();
 //$my_user=$_SESSION["usr"];

    //echo "/".$edad."/"
    
include 'cat_alcaldia.php';
?>
	

	

<form method="POST" id="guardarparticipante">

  <input type="hidden" id="area" value="<?php echo $area; ?>" >
  <input type="hidden" id="idusuario" value="<?php echo $idusuario; ?>" >
  <!--<input type="hidden" id="edad" value="<?php echo $edad; ?>" >-->
  <input type="hidden" value="0" id="distrito" name="distrito">
  <div>
    <div>




     <!--<div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">* Título del ensayo</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" name="titulo" id="titulo"  value="<?php echo $titulo; ?>" maxlength="99" <?php echo $style_disabled2;?> >
      </div>
    </div>
    <div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">* Seudónimo</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" name="sobrenombre" id="sobrenombre"  value="<?php echo $sobrenombre; ?>" maxlength="49" <?php echo $style_disabled2;?> >
      </div>
    </div>-->

     <div class="row form-group">
      <!--<button>Solicitar Edición de datos</button>-->
     </div>



    <div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">Primer apellido</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder"  name="paterno" id="paterno"  value="<?php echo $paterno; ?>" <?php echo $style_disabled;?> maxlength="49">
      </div>
    </div>

    <div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">Segundo apellido</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" name="materno" id="materno" value="<?php echo $materno; ?>" <?php echo $style_disabled;?> maxlength="49">
      </div>
    </div>

    <div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">Nombre(s)</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" name="nombre" id="nombre" value="<?php echo $nombre; ?>" <?php echo $style_disabled;?> maxlength="49">
      </div>
    </div>



   


    <div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">Edad <span style="font-size: 8pt;"></span></label>


      <div class="col-sm-4">
        <input  type="text" class="form-control noborder style_disabled" id="edad"  name="edad" value="<?php echo $edad; ?>" <?php echo $style_disabled;?> >
      </div>
      <div class="col-sm-4">
        <input  type="text" class="form-control noborder style_disabled" id="fecha_nacimiento"  name="fecha_nacimiento" value="<?php echo $fecha_nacimiento; ?>" <?php echo $style_disabled;?> >
      </div>
    </div>
    <div class="form-group row">

      <label class="col-sm-4 control-label">Categoría</label>
      <div class="col-sm-8">
        <select  class="form-control input-medium" name="categoria" id="categoria" <?php echo $style_disabled;?> >                               

                     <option value="0" <?php if($edad==0) echo 'selected'; ?> disabled>Tu edad debe estar incluida en una de las categorías</option>
                    <option value="1" <?php if($edad>=11&&$edad<=17) echo 'selected';?> >Categoría 12 a 17 años</option>
                    <option value="2" <?php if($edad>=18&&$edad<=29) echo 'selected';?> >Categoría 18 a 29 años</option>
                   

                    
          
        </select>
      </div>

    </div>

    
    <?php

    
      echo '<input  type="hidden" class="form-control noborder" id="tutor" name="tutor" value="">';

    
    ?>
    <div class="row form-group">

      <label class="control-label col-sm-4" for="nombre">Correo electrónico del participante</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" id="correo"  name="correo" value="<?php echo $correo; ?>" <?php echo $style_disabled;?> >
      </div>
    </div>


     <div class="row form-group">

      <label  class="control-label col-sm-4" for="nombre">* Género</label>

      <div class="col-sm-8">
        <!--<input  type="text" class="form-control noborder style_disabled" id="genero" name="genero" value="<?php echo $genero; ?>" <?php echo $style_disabled2;?> >-->

        <select  class="form-control input-medium" name="genero" id="genero" <?php echo $style_disabled2;?>>                               
                  <option value="0" selected disabled>Selecciona una opción</option>
                  <option value="M" <?php if($genero=='M') echo 'selected';?> >Masculino</option>
                  <option value="F" <?php if($genero=='F') echo 'selected';?> >Femenino</option>
                  <option value="X" <?php if($genero=='X') echo 'selected';?> >No se identifica</option>
                  
          </select>


      </div>
    </div>    

    <div class="row form-group">

      <label class="control-label col-sm-4" for="nombre">* Teléfono de contacto</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" id="tel1" name="tel1" value="<?php echo $tel1; ?>" <?php echo $style_disabled2;?> maxlength="20">
      </div>
    </div>

    <!--<div class="row form-group">

      <label class="control-label col-sm-4" for="nombre">*Teléfono celular</label>

      <div class="col-sm-8">
        <input  type="text" class="form-control noborder" id="tel2" name="tel2" value="<?php echo $tel2; ?>" <?php echo $style_disabled2;?> maxlength="20">
      </div>
    </div>-->


    
   <!-- <hr class="small">
     <div class="form-check">


      <input  type="checkbox" class="form-check-input" id="extranjero" name="extranjero" <?php echo $style_disabled2;?> <?php if($extranjero){ echo "checked"; } ?>  onchange="checkextranjero();">

      <label class="form-check-label" for="nombre" style="font-size: 13pt; line-height: 80%;">Registro desde el extranjero</label>   
     
    </div> 
    <div class="row mt-2">
      <div class="alert alert-warning" id="mensajeextranjero" style="display: none;">
        Sólo para personas que residan en el extranjero.
      </div>
    </div>
    <hr class="small">-->
  
    








     <div class="row form-group" >

      <label class="form-check-label col-sm-4" for="nombre">* País</label>

      <div class="col-sm-8">
       

         <select class="form-control noborder" id="pais" name="pais"  <?php echo $style_disabled2;?> onchange="fnSelectPais()">
          <option value="0"  selected disabled>Selecciona una opción</option>


          <?php
            for($i=1;$i<sizeof($paises);$i++){
              echo '<option value="'.$i.'"';
                if($pais==$i){echo 'selected';}

                 echo '>'.$paises[$i].'</option>';

            }

          ?>
          
          
        </select>
      </div>
    </div>


    <div class="row form-group bloqueentidad" id="bloqueentidad">

          <label  class="control-label col-sm-4" id="label-entidad-ciudad">* Entidad</label>

          <div class="col-sm-8">
            <input type="text" class="form-control noborder" id="entidad" name="entidad"  value="<?php echo $entidad; ?>" maxlength="99" <?php echo $style_disabled;?> > 
          </div>
    </div>


     



    <div class="row form-group" id="bloquedemarcacion" >

      <label  class="control-label col-sm-4"><p>Demarcación territorial</p> <span style="font-size: 9pt;">(Si vives en la Ciudad de México)</span></label>

      <div class="col-sm-8">
        <select class="form-control noborder" id="alcaldia" name="alcaldia" <?php echo $style_disabled;?> >
          <option value="0"  selected disabled >Selecciona una opción</option>


          <?php
            for($i=2;$i<sizeof($cat_alcaldia);$i++){
              echo '<option value="'.$i.'"';
                if($alcaldia==$i){echo 'selected';}

                 echo '>'.$cat_alcaldia[$i].'</option>';

            }

          ?>
          
          
        </select>

       
      </div>
    </div>

    <div class="row form-group" id="pais" <?php if(!$extranjero){ echo 'style="display: none;"'; } ?>>

      <label  class="control-label col-sm-4">* País de residencia</label>

      <div class="col-sm-8">
        

        <div class="row form-group bloquepais" id="bloquepais">

         <!-- <label  class="control-label col-sm-4">País</label>-->

          <div class="col-sm-8">
            <input type="text" class="form-control noborder" id="textpais" name="textpais"  value="<?php echo $pais; ?>" maxlength="99" <?php echo $style_disabled2;?> <?php if(!$extranjero){echo 'disabled';} ?> >
          </div>
        </div>
      </div>
    </div>

    <!--<div class="row form-group">
                              
      <label class="control-label col-sm-4" for="nombre">* Supuesto en el que recae mi derecho a participar</label>
      
      <div class="col-sm-8">
        <input type="checkbox" name="resido_cdmx" id="resido_cdmx" <?php if($resido_cdmx) echo "checked"; ?> <?php echo $style_disabled2;?>> Resido en la Ciudad de México <br>
        <input type="checkbox" name="soyoriundo" id="soyoriundo" <?php if($soyoriundo) echo "checked"; ?> <?php echo $style_disabled2;?> > Soy oriundo de la Ciudad de México <br>
        <input type="checkbox" name="soyoriginario" id="soyoriginario" <?php if($soyoriginario) echo "checked"; ?> <?php echo $style_disabled2;?> > Soy hija/o de madre o padre originario de la Ciudad de México <br>
      </div>
    </div>
  -->

    
    

    <!--<div class="row form-group">

      <label class="control-label col-sm-4" for="nombre">* ¿Cómo te enteraste del concurso?</label>

      <div class="col-sm-8">
        <select class="form-control noborder" id="te_enteraste" name="te_enteraste" <?php echo $style_disabled2;?>>
          <option value="0" disabled selected >Selecciona una opción</option>
          <option value="1" <?php if($te_enteraste==1){echo 'selected';} ?> >Página de internet</option>
          <option value="2" <?php if($te_enteraste==2){echo 'selected';} ?> >Redes sociales</option>
          <option value="3" <?php if($te_enteraste==3){echo 'selected';} ?> >Dirección distrital</option>
          <option value="4" <?php if($te_enteraste==4){echo 'selected';} ?> >Cartel</option>
          <option value="5" <?php if($te_enteraste==5){echo 'selected';} ?> >Díptico</option>
          <option value="6" <?php if($te_enteraste==6){echo 'selected';} ?> >Escuela</option>
        </select>
      </div>
    </div> -->
    <hr>
    <!--<div class="row form-group" >

          <label  class="control-label col-sm-4" ><b> Enlace del video</b></label>

          <div class="col-sm-8">
            <input type="text" class="form-control noborder" id="video0" name="video0"  value="<?php echo $video1; ?>" maxlength="499" <?php echo $style_disabled2;?> > 
          </div>
    </div>

    <hr>-->

    <p class="badge badge-secondary"> * Campos obligatorios</p> 


  </div>
  <br>



</div> <!--- conv -->




<div id="div_guardar" class="row">

  <div id="errorMsg"></div>

  <input type="button" value="Guardar" id="btn_guardar" class="control-form btn btn-primary btnguardar" <?php echo $style_disabled2;?>  onclick="this.disabled=true; guardarparticipante()">

</div>
<span id="spanguardar"></span>



</form>
	
		  
	