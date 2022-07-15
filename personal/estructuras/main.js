notificacion
$(document).ready(function(){

     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');

     $('#icon').load('modulos/extras/inicio/iconos.php');


    $('#imagenProceso').hide();

    cargaDatoPagina();
    comprobarCorreo();


    function sacarSelect() {
      
       $("#planillaDocente").removeClass("nav-link active");
      $("#planillaDocente").addClass("nav-link");

      $("#ciclo").removeClass("nav-link active");
      $("#ciclo").addClass("nav-link");

      $("#encabesados").removeClass("nav-link active");
      $("#encabesados").addClass("nav-link");
      $("#informes").removeClass("nav-link active");
      $("#informes").addClass("nav-link");

    

      $("#usuarioOtro").removeClass("nav-link active");
      $("#usuarioOtro").addClass("nav-link");

      $("#posteo").removeClass("nav-link active");
      $("#posteo").addClass("nav-link");


      $("#modeloDos").removeClass("nav-link active");
      $("#modeloDos").addClass("nav-link");

      $("#modeloUno").removeClass("nav-link active");
      $("#modeloUno").addClass("nav-link");


      $("#datosSitio").removeClass("nav-link active");
      $("#datosSitio").addClass("nav-link");

      $("#datos_Institucion").removeClass("nav-link active");
      $("#datos_Institucion").addClass("nav-link");

      $("#datosPlanEstudios").removeClass("nav-link active");
      $("#datosPlanEstudios").addClass("nav-link");


      $("#asignaturas").removeClass("nav-link active");
      $("#asignaturas").addClass("nav-link");

      $("#anuncioAlumnoCantidadEstadistica").removeClass("nav-link active");
      $("#anuncioAlumnoCantidadEstadistica").addClass("nav-link");


      $("#usuariosEstadistica").removeClass("nav-link active");
      $("#usuariosEstadistica").addClass("nav-link");

      $("#cursos").removeClass("nav-link active");
      $("#cursos").addClass("nav-link");

      $("#cargaAlumno").removeClass("nav-link active");
      $("#cargaAlumno").addClass("nav-link");

      $("#cargaAlumnoPre").removeClass("nav-link active");
      $("#cargaAlumnoPre").addClass("nav-link");

$("#habilitarDocente").removeClass("nav-link active");
      $("#habilitarDocente").addClass("nav-link");


      $("#cargaDocente").removeClass("nav-link active");
      $("#cargaDocente").addClass("nav-link");

      $("#inscripNota").removeClass("nav-link active");
      $("#inscripNota").addClass("nav-link");

      $("#libretaDigital").removeClass("nav-link active");
      $("#libretaDigital").addClass("nav-link");

      $("#planillaCentralizadora").removeClass("nav-link active");
      $("#planillaCentralizadora").addClass("nav-link");

      $("#analiticos").removeClass("nav-link active");
      $("#analiticos").addClass("nav-link");

      $("#asistenciaAlumno").removeClass("nav-link active");
      $("#asistenciaAlumno").addClass("nav-link");

      $("#actas").removeClass("nav-link active");
      $("#actas").addClass("nav-link");

    

     
      $("#circularProfe").removeClass("nav-link active");
      $("#circularProfe").addClass("nav-link");

    

      $("#novedades").removeClass("nav-link active");
      $("#novedades").addClass("nav-link");

      $("#directivoDatos").removeClass("nav-link active");
      $("#directivoDatos").addClass("nav-link");

      $("#historia").removeClass("nav-link active");
      $("#historia").addClass("nav-link");

      $("#anuncioAlumno").removeClass("nav-link active");
      $("#anuncioAlumno").addClass("nav-link");

      $("#anuncioProfe").removeClass("nav-link active");
      $("#anuncioProfe").addClass("nav-link");

      $("#estadisticaApro").removeClass("nav-link active");
      $("#estadisticaApro").addClass("nav-link");

      $("#planillaNotas").removeClass("nav-link active");
      $("#planillaNotas").addClass("nav-link");


     
         $("#generarPedidoAdmin").removeClass("nav-link active");
      $("#generarPedidoAdmin").addClass("nav-link");

          $("#generarPedido").removeClass("nav-link active");
      $("#generarPedido").addClass("nav-link");

           $("#correos").removeClass("nav-link active");
      $("#correos").addClass("nav-link");

           $("#correosSER").removeClass("nav-link active");
      $("#correosSER").addClass("nav-link");


            $("#notificacion").removeClass("nav-link active");
      $("#notificacion").addClass("nav-link");

     $("#ingresoSistema").removeClass("nav-link active");
      $("#ingresoSistema").addClass("nav-link");


        $("#collapseOne").collapse('hide');

    }










 $("#generarPedidoAdmin").click(function(){

              
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/generarPedidoAdmin/buscar.php');

       
            sacarSelect();

        $("#generarPedidoAdmin").removeClass("nav-link");
        $("#generarPedidoAdmin").addClass("nav-link active");  


   
    });



 $("#ingresoSistema").click(function(){

              
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/estadistica/ingresoSistema/ingresoSistema.php');

       
            sacarSelect();

        $("#ingresoSistema").removeClass("nav-link");
        $("#ingresoSistema").addClass("nav-link active");  


   
    });



 



 $("#generarPedido").click(function(){

              
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/generarPedido/generarPedidos.php');

            sacarSelect();

        $("#generarPedido").removeClass("nav-link");
        $("#generarPedido").addClass("nav-link active");  


   
    });




 $("#correosSER").click(function(){

              
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/cargaDatos/correosSer/correo.php');

       sacarSelect();

        $("#correosSER").removeClass("nav-link");
        $("#correosSER").addClass("nav-link active");  

   
    });



 $("#correos").click(function(){

              
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/cargaDatos/correos/correos.php');

       sacarSelect();

        $("#correos").removeClass("nav-link");
        $("#correos").addClass("nav-link active");  

   
    });








$('#buscar').keydown(function (e){

 if(e.keyCode == 13){ 
      
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

    

         buscar = $("#buscar").val();
     
         
       $.ajax({
            url: "modulos/buscarDocentesAlumnos/elementos/session.php",
            type: "POST",
            dataType: "json",
            data: {buscar:buscar},
            success: function(res){

                

                if (res=="1") {
                      $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
                 $('#buscarTablaInstitucional').load('modulos/buscarDocentesAlumnos/buscar.php');
               

                }

                 
            }
        });





} 



})




 $("#irInicio").click(function(){

              
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
       $('#tablaInstitucional').load('modulos/extras/inicio/iconos.php');



   
    });







    $("#buscarFinal").click(function(){

              
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

    

         buscar = $("#buscar").val();
     
         
       $.ajax({
            url: "modulos/buscarDocentesAlumnos/elementos/session.php",
            type: "POST",
            dataType: "json",
            data: {buscar:buscar},
            success: function(res){

                

                if (res=="1") {
                         $('#imagenProceso').show();
                    $('#contenidoAyuda').html(''); 
                       $('#contenidoCursos').html('');
                    $('#tablaInstitucional').html('');
        
                 $('#buscarTablaInstitucional').load('modulos/buscarDocentesAlumnos/buscar.php');
               

                }

                 
            }
        });



   
    });






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








$("#planillaNotas").click(function(){ 

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
       
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/planillaNotas/buscarPrimero.php');
        
 
        sacarSelect();

        $("#planillaNotas").removeClass("nav-link");
        $("#planillaNotas").addClass("nav-link active");  
  
      }); 

$("#preInscripcion").click(function(){ 

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
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('modulos/cargaDatos/preIncripcionAlumno/alumnos.php');
        $('#contenidoAyuda').html(''); 
        
        sacarSelect();

        $("#preInscripcion").removeClass("nav-link");
        $("#preInscripcion").addClass("nav-link active");  
  
      }); 


     $("#planillaCentralizadora").click(function(){ 

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
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/centralizadora/buscarPrimero.php');
        $('#contenidoAyuda').html(''); 
        
        sacarSelect();

        $("#planillaCentralizadora").removeClass("nav-link");
        $("#planillaCentralizadora").addClass("nav-link active");  
  
      }); 






     $("#usuarioOtro").click(function(){ 

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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/herramientas/usuarios/usuarioOtro.php');
        $('#contenidoAyuda').html(''); 
        
        sacarSelect();

        $("#usuarioOtro").removeClass("nav-link");
        $("#usuarioOtro").addClass("nav-link active");         
  
      }); 





    $("#datos_Institucion").click(function(){ 

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
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosInstitucional/datos_Institucion.php');
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#datos_Institucion").removeClass("nav-link");
        $("#datos_Institucion").addClass("nav-link active"); 
  
    });



        

    $("#planillaDocente").click(function(){

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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');

        $('#buscarTablaInstitucional').load('modulos/planillas/buscarplanilla.php');
        $('#contenidoAyuda').html(''); 

          
        sacarSelect();
        $("#planillaDocente").removeClass("nav-link");
        $("#planillaDocente").addClass("nav-link active"); 
    });


    
    $("#ciclo").click(function(){

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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');

        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/herramientas/ciclo/cicloLectivo.php');
          
        sacarSelect();
        $("#ciclo").removeClass("nav-link");
        $("#ciclo").addClass("nav-link active"); 
    });




 $("#informes").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/herramientas/conf_informe/buscar_ciclo.php');
        sacarSelect();
        $("#informes").removeClass("nav-link");
        $("#informes").addClass("nav-link active"); 
    });



    $("#encabesados").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/herramientas/cabesados/buscarCicloLectivo.php');
        sacarSelect();
        $("#encabesados").removeClass("nav-link");
        $("#encabesados").addClass("nav-link active"); 
    });

     $("#datosPlanEstudios").click(function(){

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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosPlanEstudio/planEstudios.php');
         
        sacarSelect();
        $("#datosPlanEstudios").removeClass("nav-link");
        $("#datosPlanEstudios").addClass("nav-link active");

      });

     $("#asignaturas").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAsignaturas/asignaturas_Selec.php');
         
        sacarSelect();
        $("#asignaturas").removeClass("nav-link");
        $("#asignaturas").addClass("nav-link active");

      });




      $("#cursos").click(function(){



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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/Selepcion_Curso.php');
        
        sacarSelect();
        $("#cursos").removeClass("nav-link");
        $("#cursos").addClass("nav-link active");
    

      });

     $("#cargaAlumnoPre").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/preIncripcionAlumno/alumnos.php');
        sacarSelect();
        $("#cargaAlumnoPre").removeClass("nav-link");
        $("#cargaAlumnoPre").addClass("nav-link active");
    
    });



    $("#cargaAlumno").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAlumno/alumnos.php');
        sacarSelect();
        $("#cargaAlumno").removeClass("nav-link");
        $("#cargaAlumno").addClass("nav-link active");
    
    });


    


    $("#habilitarDocente").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/habilitarDocente/docenteHabilitacion.php');
        sacarSelect();
        $("#habilitarDocente").removeClass("nav-link");
        $("#habilitarDocente").addClass("nav-link active");
    
    });

    $("#cargaDocente").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/cargaDatos/datosDocente/docente.php');
        sacarSelect();
        $("#cargaDocente").removeClass("nav-link");
        $("#cargaDocente").addClass("nav-link active");
    
    });

    $("#cargaUsuarios").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('modulos/herramientas/usuarios/usuarioSistema.php');
        sacarSelect();
        $("#cargaUsuarios").removeClass("nav-link");
        $("#cargaUsuarios").addClass("nav-link active");
        
    });



    $("#notificacion").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
         $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/notificaciones/buscarCiclo.php');
      
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#notificacion").removeClass("nav-link");
        $("#notificacion").addClass("nav-link active");
        
  
    });












    $("#inscripNota").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
         $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/matriculacion/Inscrp_BuscarCursos.php');
      
        $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#inscripNota").removeClass("nav-link");
        $("#inscripNota").addClass("nav-link active");
        
  
    });


    $("#libretaDigital").click(function(){
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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/libretaFicha/Inscrp_BuscarCursosLibretaDigitalPri.php');
         
      
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#libretaDigital").removeClass("nav-link");
        $("#libretaDigital").addClass("nav-link active");
        

    });

 


    $("#posteo").click(function(){

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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/herramientas/confiPosteo/posteo.php');
        $('#contenidoAyuda').html(''); 
    
        sacarSelect();
        $("#posteo").removeClass("nav-link");
        $("#posteo").addClass("nav-link active");
        
    });

    $("#actas").click(function(){

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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html(''); 
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/actasExamen/actasBuscar.php');
        $('#contenidoAyuda').html(''); 
        
        sacarSelect();
        $("#actas").removeClass("nav-link");
        $("#actas").addClass("nav-link active");
    
    });







    $("#analiticos").click(function(){
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
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/alumnosAnalitico1.php');  
        sacarSelect();
        $("#analiticos").removeClass("nav-link");
        $("#analiticos").addClass("nav-link active");
    
    });







     $("#asistenciaAlumno").click(function(){
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
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/asistencia/asistenciaAlumno.php');
        
        sacarSelect();
        $("#asistenciaAlumno").removeClass("nav-link");
        $("#asistenciaAlumno").addClass("nav-link active"); 
    });

    $("#directivoDatos").click(function(){

         $.blockUI({ 
                                    message: '<h1>Espere !! <i class="fa fa-sync fa-spin"></i> <i class="fa fa-sync fa-spin"></i></h1>',
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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/directivos/datosDire.php');
        
        sacarSelect();
        $("#directivoDatos").removeClass("nav-link");
        $("#directivoDatos").addClass("nav-link active");

        
        
    });




     $("#novedades").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/novedades/novedades.php');
        
        sacarSelect();
        $("#novedades").removeClass("nav-link");
        $("#novedades").addClass("nav-link active");

        
    });

      $("#historia").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/historia/historia.php');
        
      
        sacarSelect();
        $("#historia").removeClass("nav-link");
        $("#historia").addClass("nav-link active");

    });

       $("#circularProfe").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/circulares/circulares.php');
        
        sacarSelect();
        $("#circularProfe").removeClass("nav-link");
        $("#circularProfe").addClass("nav-link active");
    });




       $("#usuariosEstadistica").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/estadistica/estadisticaUsuarios.php');
        
        sacarSelect();
        $("#usuariosEstadistica").removeClass("nav-link");
        $("#usuariosEstadistica").addClass("nav-link active");
        
    });



        $("#estadisticaApro").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
       
        $('#buscarTablaInstitucional').load('modulos/estadistica/buscarEstadisticaAprobadoUno.php');
        
        sacarSelect();
        $("#estadisticaApro").removeClass("nav-link");
        $("#estadisticaApro").addClass("nav-link active");
        
    });




       $("#anuncioAlumnoCantidadEstadistica").click(function(){


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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/estadistica/estadisticaCantidadAlumnos.php');
        
        sacarSelect();
        $("#anuncioAlumnoCantidadEstadistica").removeClass("nav-link");
        $("#anuncioAlumnoCantidadEstadistica").addClass("nav-link active");
        
    });



       $("#anuncioAlumno").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/anuncios/alumnos/anunciosAlumno.php');
        
        sacarSelect();
        $("#anuncioAlumno").removeClass("nav-link");
        $("#anuncioAlumno").addClass("nav-link active");
        
    });

    
       $("#anuncioProfe").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        
        $('#tablaInstitucional').load('modulos/anuncios/docentes/anunciosDocentes.php');
        sacarSelect();
        $("#anuncioProfe").removeClass("nav-link");
        $("#anuncioProfe").addClass("nav-link active");
        
        
        
    });

    $("#cerrarSession").click(function(){
      $('#imagenProceso').show();


    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
    
    $('#imagenProceso').hide();


  }); 

    $("#datosSitio").click(function(){

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
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/cargaDatos/datosSitio/datosAplicativo.php');
        
     sacarSelect();
        $("#datosSitio").removeClass("nav-link");
        $("#datosSitio").addClass("nav-link active");
        
                  
   
  }); 









      



});







function comprobarCorreo() {
  

        $.ajax({
        url: "estructuras/bd/consultaDatos.php",
        type: "POST",
        data: {},
        success: function(res){ 


            if (res==0) {
      
                Swal.fire({
                        title: "Correo Electronico",
                        input: "email",
                        showCancelButton: true,
                        confirmButtonText: "Guardar",
                        cancelButtonText: "Cancelar",
                        inputValidator: nombre => {
                            // Si el valor es válido, debes regresar undefined. Si no, una cadena
                            if (!nombre) {
                                return "Por favor escribe tu Correo";
         
                            } else {

                                    if(nombre.indexOf('@', 0) == -1 || nombre.indexOf('.', 0) == -1) {
                                        return "Correo invalido";
                                    }else{
                                         return undefined;
                                    }

                            }
                        }
                    })
                    .then(resultado => {
                        if (resultado.value) {
                            let nombre = resultado.value;

                            ajendarCorreo(nombre);

                           


                        }else{

                            toastr.warning('Recuerde de actualizar sus correo');
                            toastr.success('Bienvenido !!');
                        }
                    });




       }else{

            toastr.success('Bienvenido !!');
       }
             


       
              
        }        
    });

}



function ajendarCorreo(correo){


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


   $.ajax({
        url: "estructuras/bd/ajendarcorreo.php",
        type: "POST",
        data: {correo:correo},
        success: function(res){ 


            if (res==1) {
      
         
                toastr.info('Correo ajendado');
                toastr.success('Bienvenido !!');


            }else{

            toastr.error('Problema con el servidor, comuníquese con el administrador');
            }
             

               $.unblockUI();  
       
              
        }        
    });


}










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