function crearusuario(){

        //  alert("El entro a funcion");


        

         //document.getElementById("main_container").setAttribute("style", "background-color:#F00;");
         //document.getElementById("main_container").setAttribute("style", "pointer-events: none;");
         //$('#main_container').click(false);
         //$("#main_container").children().attr("disabled","disabled");


   
       var nombre=document.getElementById("nombre").value;
	
	   var paterno=document.getElementById("paterno").value;
	
	   var materno=document.getElementById("materno").value;

       
       //var genero=document.getElementById("genero").value;
    
       var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;

       var edad_califica=document.getElementById("edad_califica").value;

       var categoria=document.getElementById("categoria").value;


	
       var user=document.getElementById("user").value;
       var pass1=document.getElementById("pass1").value;
       var pass2=document.getElementById("pass2").value;

       //var area=document.getElementById("sel").value;
       var correo=document.getElementById("correo").value;
       var correo2=document.getElementById("correo2").value;
	
	   	var tmptxt=document.getElementById("tmptxt"). value;
		var tmptxt2=document.getElementById("tmptxt2"). value;
        var error=0;
        var error_string="";


	
       
        if (nombre == 0)
        {
            error_string+="<p>El campo nombre no puede estar vacío</p>";
            error++;
            
        } //nombre
	
	
	    if (paterno == 0)
        {
            error_string+="<p>El campo primer apellido no puede estar vacío</p>";
            error++;
            
        } //paterno
	
	
	    if (materno == 0)
        {
           error_string+="<p>El campo segundo apellido no puede estar vacío</p>";
        
            error++;
            
        } //materno

        /*if (genero == 0)
        {
            error_string+="<p>Selecciona una opción en el campo género</p>";
            error++;
            
        } //genero*/


        if (edad_califica == 0 ||edad_califica == '0')
        {
            error_string+="<p>"+"Fecha de nacimiento fuera del rango permitido"+"</p>";
            
            error++;
            
        } //materno*/
        
    
        if (user == 0)
        //alert("Hola!!");
        {
            error_string+="<p>"+"El campo usuario no debe estar vacío"+"</p>";
            //$("#user").focus();
            error++;
            
        }//user
        
        if (pass1 == 0)
        //alert("Hola!!");
        {
            error_string+="<p>"+"El campo contraseña no debe estar vacío"+"</p>";
            //$("#pass1").focus();
            error++;
            
        }//pass1

        if (pass2 == 0)
        //alert("Hola!!");
        {
            error_string+="<p>"+"El campo repetir contraseña no debe estar vacío"+"</p>";
            //$("#pass2").focus();
            error++;
            
        }//pass2
        
        if (pass1 != pass2)
        //alert ("Hola");
        {
            error_string+="<p>"+"La contraseña no coincide"+"</p>";
            error++;
            
        }// valida contraseña
        
        
       /* if ((area == undefined)||(area == 0))
        {
            alert("Seleccione un tipo de Concurso");
            //$("#sel").focus();
            error++;
            
        }//sel*/
        
        
        if (correo == 0)
        {
            error_string+="<p>"+"El campo correo no debe estar vacío"+"</p>";
            error++;
            //$("#correo").focus();
            
        }//correo
        
        if (/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,4})$/.test(correo)){
            //alert("La dirección de email es correcta.");
        } else {
            error_string+="<p>"+"La dirección de email es incorrecta."+"</p>";
            error++;
            

        }
        

        if (correo2 == 0)
        {
            error_string+="<p>"+"El campo repetir correo no debe estar vacío"+"</p>";
            //$("#correo2").focus();
            error++;
            
        }//correo
        
        if (correo != correo2)
        //alert ("Hola");
        {
            error_string+="<p>"+"El correo electrónico no coincide"+"</p>";
            error++;
            
        }
        
        if(tmptxt==0)
		{
		   error_string+="<p>"+"El campo del CAPCHA no debe estar vacío"+"</p>";
            //$("#tmptxt").focus();
            error++;
            
		}
	
        if ( tmptxt == tmptxt2)
			{
				error_string+="<p>"+" El CAPCHA no coincide"+"</p>";
                 error++;
            
				
			}

        var textloader='<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
        document.getElementById("errormsg").innerHTML=textloader;

        document.getElementById("main_container").setAttribute("style", "pointer-events: none;");

        

        

        //return false;


        

        //alert(edad_califica+" * ");

        if(error>0){
            document.getElementById("btn_crearusuario").disabled=false;
            document.getElementById("btn_crearusuario").innerHTML="Crear cuenta de usuario";
            document.getElementById("errormsg").innerHTML="<div class='alert alert-warning' >"+error_string+"</div>";
            document.getElementById("main_container").setAttribute("style", "pointer-events: auto;");
            return false;

        }
        
               
    //var datos="action=insert"+"&nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&genero="+genero+"&fecha_nacimiento="+fecha_nacimiento+"&user="+user+"&pass1="+pass1+"&pass2="+pass2+"&area="+area+"&concurso="+area+"&correo="+correo;
    var datos="action=insert"+"&nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&user="+user+"&pass1="+pass1+"&pass2="+pass2+"&correo="+correo+"&fecha_nacimiento="+fecha_nacimiento;
       
       
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var resultado=this.responseText;
                //alert(resultado);

                if(resultado=='1'||resultado=='2'||resultado=='12'||resultado==1||resultado==2||resultado==12){
                    var texto="";
                    
                    if(resultado=='1'||resultado=='12'||resultado==1||resultado==12)texto+="<div class='alert alert-warning' >El nombre de usuario ya está registrado.</div>";
                    if(resultado=='2'||resultado=='12'||resultado==2||resultado==12)texto+="<div class='alert alert-warning' >El correo ya está registrado.</div>";

                    document.getElementById("errormsg").innerHTML =texto;
                    document.getElementById("btn_crearusuario").disabled=false;
                    document.getElementById("btn_crearusuario").innerHTML="Crear cuenta de usuario";
                    document.getElementById("main_container").setAttribute("style", "pointer-events: auto;");
                    //return false;
                    
                }else{
                    document.getElementById("main_container").innerHTML = resultado;
                     document.getElementById("main_container").setAttribute("style", "pointer-events: auto;");

                }
                


            }
        };
	
	xmlhttp.open("POST", "usuarios.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
    xmlhttp.send(datos);
/**/
}

function guardarparticipante(){

  //alert("gdrparti");

         errors=0;
         error_string="";
   
     
      

       var nombre=document.getElementById("nombre").value;
       var paterno=document.getElementById("paterno").value;
       var materno=document.getElementById("materno").value;
       var genero=document.getElementById("genero").value;
       var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;
       var edad=document.getElementById("edad").value;
       var idusuario=document.getElementById("idusuario").value;
       //var area=document.getElementById("area").value;
       //var distrito=document.getElementById("distrito").value;
       var correo=document.getElementById("correo").value;
       var categoria=document.getElementById("categoria").value;
       
       var pais=document.getElementById("pais").value;
       var entidad=encodeURIComponent(document.getElementById("entidad").value);
       var alcaldia=document.getElementById("alcaldia").value;
       //var extranjero=+document.getElementById('extranjero').checked;
       //alert(extranjero);


       /*var sobrenombre=document.getElementById("sobrenombre").value;
       if(sobrenombre==""){
        errors++;
        error_string+="<p>El campo <b>seudónimo</b> no puede estar vacío</p>";

       }*/
       



       
       /*var titulo=document.getElementById("titulo").value;
       if(titulo==""){
        errors++;
        error_string+="<p>El campo <b>título</b> no puede estar vacío</p>";

       }*/

       //var edad=document.getElementById("edad").value;

       if(isNaN(edad)){
        
          errors++;
          error_string+="<p>El campo <b>edad</b> no es un número válido</p>";
         

       }

       if(edad<12||edad>29){
        
          errors++;
          error_string+="<p>El campo <b>edad</b> no está dentro del rango permitido</p>";
         

       }

       
       if(genero=="0"){
        errors++;
        error_string+="<p>Debes seleccionar una opción en el campo <b>género</b>.</p>";

       }
      


       var tel1=document.getElementById("tel1").value;

        if(tel1==""){
            errors++;
            error_string+="<p>El <b>teléfono de contacto</b> no debe estar vacío</p>";
        }
       if(isNaN(tel1)){
        errors++;
        error_string+="<p>El <b>teléfono de contacto</b> debe contener números únicamente</p>";

          

       }

       if(tel1.toString().length<10){
          errors++;
          error_string+="<p>El <b>teléfono de contacto</b> debe contener al menos 10 dígitos</p>";

         }

       


       if(pais=="0"){
        errors++;
        error_string+="<p>Debes seleccionar una opción en el campo <b>país</b>.</p>";

       }

       if(entidad==""){
        errors++;
        error_string+="<p>El campo <b>entidad</b> no debe estar vacío</p>";

       }

        /*var video0=encodeURIComponent(document.getElementById("video0").value);

        if(video0==""){
            errors++;
            error_string+="<p>El <b>enlace del video</b> no debe estar vacío</p>";
        }*/

        var video0="";


       
       /*
       var tel2=document.getElementById("tel2").value;
       if(isNaN(tel2)||tel2==""){
        errors++;
        error_string+="<p>El <b>teléfono celular</b> debe contener números únicamente</p>";

       }
       if(tel2.toString().length<10){
        errors++;
        error_string+="<p>El <b>teléfono celular</b> debe contener al menos 10 dígitos</p>";

       }*/
/*
       if(extranjero==0){
           var alcaldia=document.getElementById("alcaldia").value;
           if(alcaldia=="0"){
            errors++;
            error_string+="<p>Debes seleccionar una opción en el campo <b>alcaldía</b>.</p>";

           }

           var entidad="";

           if(alcaldia=="18"){

            entidad=document.getElementById("entidad").value;
            if(entidad==""){
                errors++;
                error_string+="<p>Debes escribir el nombre de una <b>entidad</b></p>";
            }

         
           }

       }else{
         var pais=document.getElementById("textpais").value;
           if(pais==""){
            errors++;
            error_string+="<p>Debes escribir el <b>país de residencia</b>.</p>";

           }



       }
/*
       

       /*var suma=0;


       var resido_cdmx=+document.getElementById("resido_cdmx").checked;
       var soyoriundo=+document.getElementById("soyoriundo").checked;
       var soyoriginario=+document.getElementById("soyoriginario").checked;
       var suma=resido_cdmx+soyoriundo+soyoriginario;
       if(suma==0){
        errors++;
        error_string+="<p>Debes seleccionar al menos uno de los checkbox de <b>Resido en la Ciudad de México, o Soy oriundo de la Ciudad de México o Soy hija/o de madre o padre originario de la Ciudad de México</b></p>";

       }*/

       

       


       /*var te_enteraste=document.getElementById("te_enteraste").value;
       if(te_enteraste=="0"){
        errors++;
        error_string+="<p>Debes seleccionar una opción en el campo <b>cómo te enteraste</b>.</p>";

       }*/



      

        if(errors>0){

           // alert(document.getElementById('div_errors').innerHTML);
            //document.getElementById("div_errors").innerHTML="xxxxxxxxx";
            document.getElementById('div_errors').innerHTML='<div class="alert alert-warning">'+error_string+'</div>';
            document.getElementById("btn_guardar").disabled=false;
           // $('#spanguardar').addClass('badge badge-warning');
           // document.getElementById("spanguardar").innerHTML='!';



              $("html, body").animate({ scrollTop: 0 }, "slow");
           
            return false;


        }

       
        
    
       
        

    
        
               
    var datos="action=insert"+"&nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&genero="+genero+"&correo="+correo;
    datos+="&fecha_nacimiento="+fecha_nacimiento+"&idusuario="+idusuario;
    datos+="&edad="+edad+"&idusuario="+idusuario+"&categoria="+categoria;
    datos+="&tel1="+tel1+"&pais="+pais+"&entidad="+entidad+"&alcaldia="+alcaldia+"&video0="+video0;
    //datos+="&extranjero="+extranjero+"&pais="+pais;
    
    //document.getElementById("menu1").innerHTML = datos;
    //alert(datos);
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("menu1").innerHTML = this.responseText;
                document.getElementById('div_errors').innerHTML='';
                



            }
        };
    
    xmlhttp.open("POST", "guardarparticipante.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
    xmlhttp.send(datos);

}

function guardarVideo(){

  var video1= encodeURIComponent(document.getElementById("video1").value);
  var idusuario=document.getElementById("idusuario").value;
  //alert(video1);

  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("video_ok").innerHTML = this.responseText;
                document.getElementById('div_errors').innerHTML='';
                
            }
        };

    var datos="&video1="+video1+"&idusuario="+idusuario;
    
    xmlhttp.open("POST", "guardarvideo.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
    xmlhttp.send(datos);


}


function fnsiguiente(){

         errors=0;
         error_string="";
   
     
      

       var nombre=document.getElementById("nombre").value;
       var paterno=document.getElementById("paterno").value;
       var materno=document.getElementById("materno").value;
       var genero=document.getElementById("genero").value;
       var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;
       var idusuario=document.getElementById("idusuario").value;
       var area=document.getElementById("area").value;
       var distrito=document.getElementById("distrito").value;
        var correo=document.getElementById("correo").value;
        var categoria=document.getElementById("categoria").value;

         var extranjero=+document.getElementById('extranjero').checked;


        if (nombre == 0)
        {
            error_string+="<p>El campo nombre no puede estar vacío</p>";
            errors++;
            
        } //nombre
  
  
      if (paterno == 0)
        {
            error_string+="<p>El campo primer apellido no puede estar vacío</p>";
            errors++;
            
        } //paterno
  
  
      if (materno == 0)
        {
           error_string+="<p>El campo segundo apellido no puede estar vacío</p>";
        
            errors++;
            
        } //materno

        if (genero == 0)
        {
            error_string+="<p>Selecciona una opción en el campo género</p>";
            errors++;
            
        } //genero


        if (edad_califica == 0 ||edad_califica == '0')
        {
            error_string+="<p>"+"Fecha de nacimiento fuera del rango permitido"+"</p>";
            
            errors++;
            
        } //materno
        
    
        
        
        
        if (correo == 0)
        {
            error_string+="<p>"+"El campo correo no debe estar vacío"+"</p>";
            errors++;
            //$("#correo").focus();
            
        }//correo
        
        if (/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,4})$/.test(correo)){
            //alert("La dirección de email es correcta.");
        } else {
            error_string+="<p>"+"La dirección de email es incorrecta."+"</p>";
            errors++;
            

        }

       

      


       var tel1=document.getElementById("tel1").value;
       if(isNaN(tel1)&&tel1!=""){
        errors++;
        error_string+="<p>El <b>teléfono local</b> debe contener números únicamente</p>";

        if(tel1.toString().length<10){
        errors++;
        error_string+="<p>El <b>teléfono local</b> debe contener al menos 10 dígitos</p>";

       }

       }


       var tel2=document.getElementById("tel2").value;
       if(isNaN(tel2)||tel2==""){
        errors++;
        error_string+="<p>El <b>teléfono celular</b> debe contener números únicamente</p>";

       }
       if(tel2.toString().length<10){
        errors++;
        error_string+="<p>El <b>teléfono celular</b> debe contener al menos 10 dígitos</p>";

       }

        if(extranjero==0){
           var alcaldia=document.getElementById("alcaldia").value;
           if(alcaldia=="0"){
            errors++;
            error_string+="<p>Debes seleccionar una opción en el campo <b>alcaldía</b>.</p>";

           }

           var entidad="";

           if(alcaldia=="18"){

            entidad=document.getElementById("entidad").value;
            if(entidad==""){
                errors++;
                error_string+="<p>Debes escribir el nombre de una <b>entidad</b></p>";
            }

         
           }

       }else{
         var pais=document.getElementById("textpais").value;
           if(pais==""){
            errors++;
            error_string+="<p>Debes escribir el <b>país de residencia</b>.</p>";

           }
          //document.getElementById("alcaldia").value=0;
           alcaldia="0";
          entidad="";

       }

       /*var suma=0;


       var resido_cdmx=+document.getElementById("resido_cdmx").checked;
       var soyoriundo=+document.getElementById("soyoriundo").checked;
       var soyoriginario=+document.getElementById("soyoriginario").checked;
       var suma=resido_cdmx+soyoriundo+soyoriginario;
       if(suma==0){
        errors++;
        error_string+="<p>Debes seleccionar al menos uno de los checkbox de <b>Resido en la Ciudad de México, o Soy oriundo de la Ciudad de México o Soy hija/o de madre o padre originario de la Ciudad de México</b></p>";

       }*/

       var domicilio=document.getElementById("domicilio").value;
       if(domicilio==""){
        //errors++;
        //error_string+="<p>El campo <b>domicilio</b> no puede estar vacío.</p>";

       }

       


       var te_enteraste=document.getElementById("te_enteraste").value;
       if(te_enteraste=="0"){
        errors++;
        error_string+="<p>Debes seleccionar una opción en el campo <b>cómo te enteraste</b>.</p>";

       }



      

        if(errors>0){

           // alert(document.getElementById('div_errors').innerHTML);
            //document.getElementById("div_errors").innerHTML="xxxxxxxxx";
            document.getElementById('div_errors').innerHTML='<div class="alert alert-warning">'+error_string+'</div>';
            document.getElementById("btn_guardar").disabled=false;
           // $('#spanguardar').addClass('badge badge-warning');
           // document.getElementById("spanguardar").innerHTML='!';



              $("html, body").animate({ scrollTop: 0 }, "slow");
           
            return false;


        }

       
               
      

     



      

        if(errors>0){

          
            document.getElementById('div_errors').innerHTML='<div class="alert alert-warning">'+error_string+'</div>';
          //  document.getElementById("btn_guardar").disabled=false;
          



              $("html, body").animate({ scrollTop: 0 }, "slow");
           
          


        }else{

            document.getElementById('div_errors').innerHTML='';
            


            $("#menu1").removeClass("active");

            $("#navmenu2").removeClass("disabled");
            $("#menu2").addClass("active");

        }



}

function evaluarCorreoRepetido(){

  var datos="mail="+document.getElementById('correo').value;

  //var repetido="x";
  

  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //repetido= this.responseText;
                document.getElementById('correo_repetido').innerHTML=this.responseText;
               
                //alert("evaluar");


              
                



            }
        };
    
    xmlhttp.open("POST", "evaluarcorreorepetido.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
    xmlhttp.send(datos);
     //return repetido;

    

      


}


function guardarparticipantedistrito(){

        errors=0;
         error_string="";
   
     
      

       var nombre=document.getElementById("nombre").value;
       var paterno=document.getElementById("paterno").value;
       var materno=document.getElementById("materno").value;
       var genero=document.getElementById("genero").value;
       var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;
       var idusuario=document.getElementById("idusuario").value;
       var area=document.getElementById("area").value;
       var distrito=document.getElementById("distrito").value;
        var correo=document.getElementById("correo").value;
        var categoria=document.getElementById("categoria").value;
        var extranjero=+document.getElementById('extranjero').checked;


        if (nombre == 0)
        {
            error_string+="<p>El campo nombre no puede estar vacío</p>";
            errors++;
            
        } //nombre
  
  
      if (paterno == 0)
        {
            error_string+="<p>El campo primer apellido no puede estar vacío</p>";
            errors++;
            
        } //paterno
  
  
      if (materno == 0)
        {
           error_string+="<p>El campo segundo apellido no puede estar vacío</p>";
        
            errors++;
            
        } //materno

        if (genero == 0)
        {
            error_string+="<p>Selecciona una opción en el campo género</p>";
            errors++;
            
        } //genero


        if (edad_califica == 0 ||edad_califica == '0')
        {
            error_string+="<p>"+"Fecha de nacimiento fuera del rango permitido"+"</p>";
            
            errors++;
            
        } //materno
        
    
        
        
        
        if (correo == 0)
        {
            error_string+="<p>"+"El campo correo no debe estar vacío"+"</p>";
            errors++;
            //$("#correo").focus();
            
        }//correo
        
        if (/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,4})$/.test(correo)){
            //alert("La dirección de email es correcta.");
        } else {
            error_string+="<p>"+"La dirección de email es incorrecta."+"</p>";
            errors++;
            

        }

       

      


       var tel1=document.getElementById("tel1").value;
       if(isNaN(tel1)&&tel1!=""){
        errors++;
        error_string+="<p>El <b>teléfono local</b> debe contener números únicamente</p>";

        if(tel1.toString().length<10){
        errors++;
        error_string+="<p>El <b>teléfono local</b> debe contener al menos 10 dígitos</p>";

       }

       }


       var tel2=document.getElementById("tel2").value;
       if(isNaN(tel2)||tel2==""){
        errors++;
        error_string+="<p>El <b>teléfono celular</b> debe contener números únicamente</p>";

       }
       if(tel2.toString().length<10){
        errors++;
        error_string+="<p>El <b>teléfono celular</b> debe contener al menos 10 dígitos</p>";

       }

        if(extranjero==0){
           var alcaldia=document.getElementById("alcaldia").value;
           if(alcaldia=="0"){
            errors++;
            error_string+="<p>Debes seleccionar una opción en el campo <b>alcaldía</b>.</p>";

           }

           var entidad="";

           if(alcaldia=="18"){

            entidad=document.getElementById("entidad").value;
            if(entidad==""){
                errors++;
                error_string+="<p>Debes escribir el nombre de una <b>entidad</b></p>";
            }

         
           }

       }else{
         var pais=document.getElementById("textpais").value;
           if(pais==""){
            errors++;
            error_string+="<p>Debes escribir el <b>país de residencia</b>.</p>";

           }

          alcaldia="0";
          entidad="";

       }

       /*var suma=0;


       var resido_cdmx=+document.getElementById("resido_cdmx").checked;
       var soyoriundo=+document.getElementById("soyoriundo").checked;
       var soyoriginario=+document.getElementById("soyoriginario").checked;
       var suma=resido_cdmx+soyoriundo+soyoriginario;
       if(suma==0){
        errors++;
        error_string+="<p>Debes seleccionar al menos uno de los checkbox de <b>Resido en la Ciudad de México, o Soy oriundo de la Ciudad de México o Soy hija/o de madre o padre originario de la Ciudad de México</b></p>";

       }*/

       var domicilio=document.getElementById("domicilio").value;
       if(domicilio==""){
        //errors++;
        //error_string+="<p>El campo <b>domicilio</b> no puede estar vacío.</p>";

       }

       


       var te_enteraste=document.getElementById("te_enteraste").value;
       if(te_enteraste=="0"){
        errors++;
        error_string+="<p>Debes seleccionar una opción en el campo <b>cómo te enteraste</b>.</p>";

       }



      

        if(errors>0){

           // alert(document.getElementById('div_errors').innerHTML);
            //document.getElementById("div_errors").innerHTML="xxxxxxxxx";
            document.getElementById('div_errors').innerHTML='<div class="alert alert-warning">'+error_string+'</div>';
            document.getElementById("btn_guardar").disabled=false;
           // $('#spanguardar').addClass('badge badge-warning');
           // document.getElementById("spanguardar").innerHTML='!';



              $("html, body").animate({ scrollTop: 0 }, "slow");
           
            return false;


        }

       
        
    
       
        

    
        
               
    var datos="action=insert"+"&nombre="+nombre+"&paterno="+paterno+"&materno="+materno+"&genero="+genero+"&correo="+correo;
    datos+="&fecha_nacimiento="+fecha_nacimiento+"&idusuario="+idusuario+"&area="+area;
    datos+="&tutor="+tutor+"&categoria="+categoria;
    datos+="&tel1="+tel1+"&tel2="+tel2+"&alcaldia="+alcaldia+"&entidad="+entidad+"&domicilio="+domicilio;
    datos+="&te_enteraste="+te_enteraste+"&distrito="+distrito+"&extranjero="+extranjero+"&pais="+pais;
    
    //document.getElementById("menu1").innerHTML = datos;
    //alert(datos);
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("div_registro").innerHTML = this.responseText;
                document.getElementById('div_errors').innerHTML='';
                



            }
        };
    
    xmlhttp.open("POST", "guardarparticipantedistrito.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
    xmlhttp.send(datos);

}







/*function rec_con(){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("container").innerHTML = this.responseText;


            }
        };


        
        xmlhttp.open("POST", "rec_con.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
        

       var user=document.getElementById("user").value;
       var correo=document.getElementById("correo").value;
       var pass1=document.getElementById("pass1").value;

    
    
        if (user == 0)
        //alert("Hola!!");
        {
            alert("El campo usuario no debe estar vacío!!");
            $("#user").focus();
            return false;
        }//user
        
        if (correo == 0)
        {
            alert("El campo correo no debe estar vacío!!");
            $("#correo").focus();
            return false;
        }//correo

        if (/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,4})$/.test(correo)){
            //alert("La dirección de email es correcta.");
        } else {
            alert("La dirección de email es incorrecta.");
                return false;
        }

        if (pass1 == 0)
        {
            alert("El campo contraseña no debe estar vacío!!");
            $("#pass1").focus();
            return false;
        }//pass1
        
                    //alert("hola!!");

               
        // var datos="action=update&user="+user+"&correo="+correo+"&pass1="+pass1;
      var datos="action=update"+"&user="+user+"&correo="+correo+"&pass1="+pass1;
      
                    //alert("hola!!");
           
       //var datos="action=insert"+"&nombre="+nombre+"&user="+user+"&pass1="+"&area="+area+"&correo="+correo;

        xmlhttp.send(datos);
  
        alert ("Contraseña actualiza correctamente!!");
}*/




function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}

function validar2(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\d]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}






function fnUpload(id,index){

          // alert("suuub");
            

            //document.getElementById("upload-button").innerHTML = 'Uploading...';

        //alert("file-select-"+index);

         var files =  document.getElementById("file-select-"+index).files[0];

         document.getElementById("file-select-"+index).value="";
   
         //var filesQueja = document.getElementById("file-quejaini")
         var diverrormsg_="div_errors";

            if(files!=undefined){

                var vsize=files.size;

                var servermaxsize=4000000;//document.getElementById("maxsize_frm").value;

                var maxsize_mb=((servermaxsize/1000)/1000).toFixed(1);


                if(vsize>servermaxsize){
                     //document.getElementById('upload-button').disabled=false;
                      $("#"+diverrormsg_).html("<div class='alert alert-warning'>El archivo excede el tamaño permitido: "+maxsize_mb+" MB <button type='button' class='close' data-dismiss='alert'>&times;</button></div>");
                       $("html, body").animate({ scrollTop: 0 }, "slow");

                    return false;
                }

                


            }


            
            

            

            
            var formData = new FormData();
           

            formData.append('file-select',files);
            formData.append('idusuario',id);     
            formData.append('index',index); 
            
            var textloader='<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
            document.getElementById("row-"+index).innerHTML = textloader;
/*
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                     fnUpdateRow(id,index);
                     document.getElementById(diverrormsg_).innerHTML = this.responseText;
                     
                    



                }
            };
    
            xmlhttp.open("POST", "upload.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"); 
            xmlhttp.send(formData);
            
*/



         var xhr = new XMLHttpRequest();

            xhr.open('POST', 'upload.php', true);


            xhr.onload = function () {
              if (xhr.status === 200) {
                // File(s) uploaded.
                //document.getElementById("upload-button").innerHTML = 'Uploaded!';

                //document.getElementById(divfileid).innerHTML = this.responseText;
                
                document.getElementById(diverrormsg_).innerHTML = this.responseText;
                fnUpdateRow(id,index);
                fnUpdateMensaje(id);
                 $("html, body").animate({ scrollTop: 0 }, "slow");

              } else {
                //alert('An error occurred!');
              }
            };

            xhr.send(formData);
            /**/
            


}

function fnUpdateRow(id,index){
  var divrow="row-"+index;

  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById('div_errors').innerHTML = this.responseText;
                document.getElementById(divrow).innerHTML = this.responseText;
                //$('#select_colonia').append = this.responseText;
              
            }
        };

        //alert(usuario+" / "+convocatoria);

        
        var parametros="idusuario="+id+"&index="+index;
        xmlhttp.open("POST", "updaterow.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.send(parametros);
}

function fnUpdateMensaje(id){
  

  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById('div_errors').innerHTML = this.responseText;
                document.getElementById("mensajeadjuntos").innerHTML = this.responseText;
                //$('#select_colonia').append = this.responseText;
              
            }
        };

        //alert(usuario+" / "+convocatoria);

        
        var parametros="idusuario="+id;
        xmlhttp.open("POST", "mensajeadjuntos.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.send(parametros);
}

function fnEdad(){

        var fecha_nacimiento=document.getElementById("fecha_nacimiento").value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById('div_errors').innerHTML = this.responseText;

                var resultado=JSON.parse(this.responseText);
               
                document.getElementById("erroredad").innerHTML = resultado.mensaje;
                document.getElementById("edad_califica").value=resultado.califica;
                document.getElementById("edad").value=resultado.edad;
                if(resultado.edad>=12&&resultado.edad<=17){//>=11
                  document.getElementById("categoria").value=1;

                }
                if(resultado.edad>=18&&resultado.edad<=29){ //<=31
                  document.getElementById("categoria").value=2;

                }

                
               
                //$('#select_colonia').append = this.responseText;
              
            }
        };

        //alert(usuario+" / "+convocatoria);

        
        var parametros="fecha_nacimiento="+fecha_nacimiento;
        xmlhttp.open("POST", "calculoedad.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.send(parametros);

        



}

function fnReenviarCorreo(id){

        var correo="";// document.getElementById("correo").value;

        
        //var correo="x";

        var myid=id;
       

        if(myid=='0'){
             
            correo=document.getElementById("correo").value;

        }else{

            correo="";

        }

        var textloader='<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>';
        document.getElementById("divcorreo").innerHTML = textloader;

        //alert(correo);


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                document.getElementById("divcorreo").innerHTML = this.responseText;

                
               
                //$('#select_colonia').append = this.responseText;
              
            }
        };

        //alert(usuario+" / "+convocatoria);

        
        var parametros="id="+id+"&correo="+correo;
        xmlhttp.open("POST", "reenviarcorreo.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.send(parametros);


}
        
    
////////////////////////////////////////////////////////////validación

 function fnRadioBusqueda(){
          var num=$("input[type='radio'][name='radio_busqueda']:checked").val()
 



           switch(num){
            case '1':  
            document.getElementById('select_nombre').disabled=false;
            document.getElementById('btn_nombre').disabled=false;


            document.getElementById('select_distrito').disabled=true;
             //document.getElementById('btn_distrito').disabled=true;

            document.getElementById('select_folio').disabled=true;
             document.getElementById('btn_folio').disabled=true;
            break;

            case '2':  
            document.getElementById('select_folio').disabled=false;
             document.getElementById('btn_folio').disabled=false;

            document.getElementById('select_nombre').disabled=true;
            document.getElementById('btn_nombre').disabled=true; 
            document.getElementById('select_distrito').disabled=true;
            //document.getElementById('btn_distrito').disabled=true;

            break;

            case '3':  
            document.getElementById('select_distrito').disabled=false;
            //document.getElementById('btn_distrito').disabled=false;

            document.getElementById('select_folio').disabled=true; 
            document.getElementById('btn_folio').disabled=true; 
            document.getElementById('select_nombre').disabled=true;
            document.getElementById('btn_nombre').disabled=true;
               // document.getElementById('select_colonia').disabled=true;
               break;
            
          }

 }

////    /////////////////////////

function fnBusquedaFolio(){

  //alert ("entro funcion folio");
  
  var val=document.getElementById('select_folio').value;

  var textloader='<div class="row"><div class="loader"></div></div>';
  document.getElementById('menu_').innerHTML = textloader; 

  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                    //document.getElementById('div_errors').innerHTML = this.responseText;
                    document.getElementById('menu_').innerHTML = this.responseText;
                    //$('#select_colonia').append = this.responseText;

        }
    };


        var parametros="accion=folio&val="+val;
        xmlhttp.open("POST", "validacionlistado.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xmlhttp.send(parametros);

}

/////////// funcion de busqueda para el nombre 
function fnBusquedaNombre(){

  //alert ("entro funcion Nombre");
  
  var val=document.getElementById('select_nombre').value;

  var textloader='<div class="row"><div class="loader"></div></div>';
  document.getElementById('menu_').innerHTML = textloader; 

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
                //document.getElementById('div_errors').innerHTML = this.responseText;
                document.getElementById('menu_').innerHTML = this.responseText;
                //$('#select_colonia').append = this.responseText;

              }
            };


            var parametros="accion=nombre&val="+val;
            xmlhttp.open("POST", "validacionlistado.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send(parametros);

          }

///////////distrito ////////////

function fnBusquedaDistrito(){

 // alert ("entro funcion disrito");
  
  var val=document.getElementById('select_distrito').value;

  var textloader='<div class="row"><div class="loader"></div></div>';
  document.getElementById('menu_').innerHTML = textloader; 

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
                //document.getElementById('div_errors').innerHTML = this.responseText;
                document.getElementById('menu_').innerHTML = this.responseText;
                //$('#select_colonia').append = this.responseText;

              }
            };


            var parametros="accion=distrito&val="+val;
            xmlhttp.open("POST", "validacionlistado.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xmlhttp.send(parametros);

          }
function fnValidar(id,cat,pais){

  

  var textloader='<div class="row"><div class="loader"></div></div>';
  document.getElementById('menu_').innerHTML = textloader; 

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('menu_').innerHTML = this.responseText;
    }
  };

  var parametros="id="+id+"&categoria="+cat+"&pais="+pais;
  xmlhttp.open("POST", "g_validaciondocumentos.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlhttp.send(parametros);

}

function fnguardarvalidaciones(){

  

  var id= document.getElementById("id").value;

  var categoria = document.getElementById("categoria").value;

  var pais = document.getElementById("pais").value;

  var edad = document.getElementById("edad").value;

  
  
    
  var status_doc1 = document.getElementById("select_status_doc1").value;
  var observa_doc1 = document.getElementById("observa_doc1").value;

  var status_doc2 = document.getElementById("select_status_doc2").value;
  var observa_doc2 = document.getElementById("observa_doc2").value;

  var status_doc3 = document.getElementById("select_status_doc3").value;
  var observa_doc3 = document.getElementById("observa_doc3").value;

  var status_doc4 = document.getElementById("select_status_doc4").value;
  var observa_doc4 = document.getElementById("observa_doc4").value;
  /*
    
  var status_doc5 = document.getElementById("select_status_doc5").value;
  var observa_doc5 = document.getElementById("observa_doc5").value;
  
  var status_doc6 = document.getElementById("select_status_doc6").value;
  var observa_doc6 = document.getElementById("observa_doc6").value;

  var status_doc7 = document.getElementById("select_status_doc7").value;
  var observa_doc7 = document.getElementById("observa_doc7").value;

 */
  
  
  
  //var cumple_requi = document.getElementById("cumple_requi").value;
  //var no_cumple_requi = document.getElementById("no_cumple_requi").value;
  var observa_requi = document.getElementById("observa_requi").value;
  
  errors=0;
/////////////////

  if(errors>0){

  
           document.getElementById('div_errors').innerHTML='<div class="alert alert-warning">'+error_string+'</div>';
            document.getElementById("btn_guardar").disabled=false;
            return false;

  }

    
  var datos="action=update"+"&id="+id+"&categoria="+categoria+"&pais="+pais+"&edad="+edad;
  datos+="&status_doc1="+status_doc1+"&observa_doc1="+observa_doc1+"&status_doc2="+status_doc2+"&observa_doc2="+observa_doc2;
  datos+="&status_doc3="+status_doc3+"&observa_doc3="+observa_doc3;
  datos+="&status_doc4="+status_doc4+"&observa_doc4="+observa_doc4;
  /*datos+="&status_doc6="+status_doc6+"&observa_doc6="+observa_doc6;
  datos+="&status_doc7="+status_doc7+"&observa_doc7="+observa_doc7;*/
  datos+="&observa_requi="+observa_requi;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('menu_').innerHTML = this.responseText;
    }
  };

  //var parametros="action=update&id="+id;
  xmlhttp.open("POST", "g_validaciondocumentos.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlhttp.send(datos);

}

////////////////////viene de archivo datospersonales.php
function fnSelectEntidad(){

   var alcaldia=document.getElementById('alcaldia').value;
  if(alcaldia==18){
    document.getElementById('entidad').disabled=false;
    document.getElementById('bloqueentidad').style.display='block';
  }else{
    document.getElementById('bloqueentidad').style.display='none';
    document.getElementById('entidad').disabled=true;
    document.getElementById('entidad').value="";

  }
 
}

function fnSelectPais(){
 

   var pais=document.getElementById('pais').value;
   //alert(pais);
  if(pais=='117'){
    document.getElementById('entidad').disabled=false;
    document.getElementById('entidad').setAttribute("style", "background-color: '#FFF';"); 
    $('#bloqueentidad').show();
    
    document.getElementById('alcaldia').disabled=false;
    document.getElementById('alcaldia').setAttribute("style", "background-color: '#FFF';"); 
    $('#bloquedemarcacion').show();
  }else{
    document.getElementById('bloquedemarcacion').style.display='none';
    document.getElementById('entidad').disabled=false;
    document.getElementById('entidad').setAttribute("style", "background-color: '#FFF';"); 
    document.getElementById('entidad').value="";
    document.getElementById('alcaldia').setAttribute("style", "background-color: '#f7f7f7';"); 

  }
}


function checkextranjero(){

   var extranjero=document.getElementById('extranjero').checked;
    //alert("check" +extranjero);
    if (extranjero)
    {
       $('#demarcacion').hide(); 
       $('#pais').show();
        $('#mensajeextranjero').show();
       $('#textpais').prop('disabled', false);

        document.getElementById("alcaldia").selectedIndex=0;
        document.getElementById("entidad").value="";
        
    }else{
      $('#demarcacion').show(); 
       $('#pais').hide();
        $('#mensajeextranjero').hide();
       $('#textpais').prop('disabled', true);

    }

}


function checkedad(){
  //alert("edad");

   var edad=document.getElementById('edad').value;
    //alert("check" +extranjero);
    if (isNaN(edad))
    {
       document.getElementById("categoria").selectedIndex=0;
        
    }else{

      if(edad>=12&&edad<=29){
        if(edad>=12&&edad<=17){
        document.getElementById("categoria").selectedIndex=1;
        }
        if(edad>=18&&edad<=23){
          document.getElementById("categoria").selectedIndex=2;
         
        }

        if(edad>=24&&edad<=29){
          document.getElementById("categoria").selectedIndex=3;
         
        }

      }else{
        document.getElementById("categoria").selectedIndex=0;
      }
      
      

    }

}



function sorteocategoria(categoria){




  var datos="&categoria="+categoria;

  var cat =["","A (14-15)", "B (15-16)", "C (16-17)", "D (18-19)"];

  document.getElementById('folio1').disabled=false;
  document.getElementById('folio2').disabled=false;
  document.getElementById('folio3').disabled=false;
  $('#s1').hide(100);

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('s1').innerHTML = this.responseText;
      $('#s1').show(1000);
      document.getElementById('titulocategoria').innerHTML = "Categoría "+cat[categoria];
    
    }
  };

  //var parametros="action=update&id="+id;
  xmlhttp.open("POST", "sorteolistado.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlhttp.send(datos);

  document.getElementById('formcategoria').value = categoria;




  /*var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    
      document.getElementById('s2').innerHTML = this.responseText;
    }
  };

  //var parametros="action=update&id="+id;
  xmlhttp.open("POST", "sorteobusqueda.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlhttp.send(datos);*/

}

function sorteobuscarfolio(id){

     document.getElementById('div_errors').innerHTML="";
     

      if(id==1){
        var folio=document.getElementById('folio1').value;
      }
      if(id==2){
        var folio=document.getElementById('folio2').value;
      }

       if(id==3){
        var folio=document.getElementById('folio3').value;
      }
  
  var categoria=document.getElementById('formcategoria').value;//oculto

  var datos="&categoria="+categoria+"&folio="+folio;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var resultado = JSON.parse(this.responseText);

      if(id==1){
        document.getElementById('res1').innerHTML=resultado.nombre;
        document.getElementById('res2').innerHTML=resultado.folio;

        document.getElementById('idparticipante1').value=resultado.folio;
        
        
          document.getElementById('res3').innerHTML=resultado.mensaje;
        
        
      }
      if(id==2){
        document.getElementById('res4').innerHTML=resultado.nombre;
        document.getElementById('res5').innerHTML=resultado.folio;

        document.getElementById('idparticipante2').value=resultado.folio;


        
          document.getElementById('res6').innerHTML=resultado.mensaje;
        
      }

      if(id==3){
        document.getElementById('res7').innerHTML=resultado.nombre;
        document.getElementById('res8').innerHTML=resultado.folio;

        document.getElementById('idparticipante3').value=resultado.folio;


        
          document.getElementById('res9').innerHTML=resultado.mensaje;
        
      }
    
    }
  };

  //var parametros="action=update&id="+id;
  xmlhttp.open("POST", "sorteobusqueda.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlhttp.send(datos);



}

function formarPareja(){

  //alert("formarpareja");

   var folio1=document.getElementById('idparticipante1').value;
   var folio2=document.getElementById('idparticipante2').value;
   var categoria=document.getElementById('formcategoria').value;

   document.getElementById('div_errors').innerHTML="";

   if(folio1==0 || folio2==0){

    document.getElementById('div_errors').innerHTML="<dic class='alert alert-warning'>Selecciona dos folios válidos</div>";

   }else{

   var datos="&folio1="+folio1+"&folio2="+folio2+"&categoria="+categoria;
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        
          document.getElementById('s2').innerHTML=this.responseText;

          sorteocategoria(categoria);
        
      
      }
    };
    xmlhttp.open("POST", "sorteoformarpareja.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(datos);


   
   }

   

}

function formarTrio(){

  //alert("formarpareja");

   var folio1=document.getElementById('idparticipante1').value;
   var folio2=document.getElementById('idparticipante2').value;
   var folio3=document.getElementById('idparticipante3').value;
   var categoria=document.getElementById('formcategoria').value;

  document.getElementById('div_errors').innerHTML="";

   if(folio1==0 || folio2==0 || folio3==0){

     document.getElementById('div_errors').innerHTML="<dic class='alert alert-warning'>Selecciona tres folios válidos</div>";

   }else{

   var datos="&folio1="+folio1+"&folio2="+folio2+"&folio3="+folio3+"&categoria="+categoria;
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        
          document.getElementById('s2').innerHTML=this.responseText;
          sorteocategoria(categoria);
        
      
      }
    };
    xmlhttp.open("POST", "sorteoformartrio.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(datos);


    
   }

   

}

function deshacersorteo(sorteo){

  //alert("formarpareja");

   var idsorteo=sorteo;
   var categoria=document.getElementById('formcategoria').value;
   
   var datos="&idsorteo="+idsorteo;
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        
          document.getElementById('s2').innerHTML=this.responseText;
        
      
      }
    };
    xmlhttp.open("POST", "sorteodeshacer.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(datos);


    sorteocategoria(categoria);
   }


  function sorteoazar(){


  var categoria=document.getElementById('formcategoria').value;//oculto

  var datos="&categoria="+categoria;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var resultado = JSON.parse(this.responseText);

      
        document.getElementById('folio1').value=resultado.folio1;
        document.getElementById('folio2').value=resultado.folio2;



                
        var total=resultado.total;
        if(total==3){
           document.getElementById('folio3').value=resultado.folio3;
            $("#div_trio").show(); 
        }

        document.getElementById('div_errors').innerHTML=resultado.total;

        
     
      

    
    }
  }
  

  //var parametros="action=update&id="+id;
  xmlhttp.open("POST", "sorteoazar.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xmlhttp.send(datos);



}



   








