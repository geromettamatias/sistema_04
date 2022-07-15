$(document).ready(function(){

    $('#tablaInstitucional').load('modulos/paginaInicio/novedades/novedades.php');



     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');


    $('#imagenProceso').hide();

    cargaDatoPagina();


    function sacarSelect() {
      
      $("#estudiante").removeClass("nav-link active");
      $("#estudiante").addClass("nav-link");

      $("#docente").removeClass("nav-link active");
      $("#docente").addClass("nav-link");

      $("#personal").removeClass("nav-link active");
      $("#personal").addClass("nav-link");

      $("#administrador").removeClass("nav-link active");
      $("#administrador").addClass("nav-link");

      $("#novedade").removeClass("nav-link active");
      $("#novedade").addClass("nav-link");


      $("#historia").removeClass("nav-link active");
      $("#historia").addClass("nav-link");

      $("#contactos").removeClass("nav-link active");
      $("#contactos").addClass("nav-link");


   

    }



      $("#usuarioTexto").click(function(){

 
      toastr.success('Es el nivel de usuario que está actualmente designado, dentro del sistema');

   
    });


   $("#autoGestionTitulo").click(function(){

      toastr.success('Sistema de Gestión escolar donde administra toda la información institucional');


   
    });

   

    $("#modeloUno").click(function(){

      $("#body1").removeClass("hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed");
      $("#body1").addClass("hold-transition sidebar-mini layout-fixed");
      

      sacarSelect();

      $("#modeloUno").removeClass("nav-link");
      $("#modeloUno").addClass("nav-link active");
   
    });

    $("#modeloDos").click(function(){
 
      $("#body1").removeClass("hold-transition sidebar-mini layout-fixed");
      $("#body1").addClass("hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed");
      
      sacarSelect();

      $("#modeloDos").removeClass("nav-link");
      $("#modeloDos").addClass("nav-link active");

    });



$("#registrar_LOGIN").click(function(){


          $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 

          
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/personales/loginPersonal.php');
       
        
});



$("#pedidoGenerar").click(function(){


      
         Swal.fire({
          title: '¡Primero debe ingresar su Usuario y Contraseña, en el apartado correspondiente!',
          text: 'El Usuario y contraseña le estará brindando la institución',
          imageUrl: '../elementos/loginImagen.png',
          imageWidth: 400,
          imageHeight: 200,
          imageAlt: 'Custom image',
        })

  
});





$("#administrador_LOGIN").click(function(){


          $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 

          
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/administradores/loginAdmin.php');
  
});

$("#personal_LOGIN").click(function(){


          $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 

          
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/personales/loginPersonal.php');
  
});

$("#docente_LOGIN").click(function(){


    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');
       
        
});


  
$("#estudiante_LOGIN").click(function(){


    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/estudiantes/loginEstudiante.php');
       
        
});




      
  
$("#estudiante").click(function(){


    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/estudiantes/loginEstudiante.php');
        sacarSelect();
        $("#estudiante").removeClass("nav-link");
        $("#estudiante").addClass("nav-link active");
        
});



$("#docente").click(function(){


    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');
        sacarSelect();
        $("#docente").removeClass("nav-link");
        $("#docente").addClass("nav-link active");
        
});




$("#docente").click(function(){


    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/docentes/loginDocente.php');
        sacarSelect();
        $("#docente").removeClass("nav-link");
        $("#docente").addClass("nav-link active");
        
});


$("#personal").click(function(){


          $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 

          
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/personales/loginPersonal.php');
        sacarSelect();
        $("#personal").removeClass("nav-link");
        $("#personal").addClass("nav-link active");
        
});


$("#administrador").click(function(){

    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/usuarios/administradores/loginAdmin.php');
        sacarSelect();
        $("#administrador").removeClass("nav-link");
        $("#administrador").addClass("nav-link active");
        
});



$("#historias").click(function(){

    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/historia/historia.php');
        sacarSelect();
        $("#historias").removeClass("nav-link");
        $("#historias").addClass("nav-link active");
        
});







$("#contactos").click(function(){

    $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i></h1>',
                                    css: { 
                                    border: 'none', 
                                    padding: '15px', 
                                    backgroundColor: '#000', 
                                    '-webkit-border-radius': '10px', 
                                    '-moz-border-radius': '10px', 
                                    opacity: .5, 
                                    color: '#fff' 
                                } }); 



        
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/directivos/datosDire.php');
        sacarSelect();
        $("#contactos").removeClass("nav-link");
        $("#contactos").addClass("nav-link active");
        
});









});



function cargaDatoPagina() {
  

        $.ajax({
        url: "estructuras/bd/datoAplicativoLeer.php",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data){  
       
            tituloS = data.titulo;
            tituloMenuS = data.tituloMenu;
            url = data.url;
            
      

            $('#logoImagenF').val('<img src="../elementos/'+url+'"   style="width: 40%;" class="mx-auto d-block">');

        

            var imagenPrevisualizacion = document.querySelector("#mostrarimagenLo");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacion.src = "../elementos/"+url+"";



                  var imagenPrevisualizacionFFF = document.querySelector("#mostrarimagenLoFFF");

            //  verificamos que sea PDF
           
                 imagenPrevisualizacionFFF.src = "../elementos/"+url+"";    







         
            //  verificamos que sea PDF
           
               imagenPrevisualizacion.src = "../elementos/"+url+"";

        $('#tituloMenuURL').val(url);

          $('#titulo').html('<title>'+tituloS+'</title>');    
                      $("#tituloMenu").html(tituloMenuS);
              
        }        
    });

}


function inscribir() {
     
      $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/inscripciones/inscribirAlumnos.php');
  
       
        
}


