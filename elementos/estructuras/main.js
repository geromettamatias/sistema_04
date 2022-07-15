$(document).ready(function(){

     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');


    $('#imagenProceso').hide();

    cargaDatoPagina();


    function sacarSelect() {
      
      $("#ciclo").removeClass("nav-link active");
      $("#ciclo").addClass("nav-link");

      $("#encabesados").removeClass("nav-link active");
      $("#encabesados").addClass("nav-link");

      $("#usuarioAdmin").removeClass("nav-link active");
      $("#usuarioAdmin").addClass("nav-link");

      $("#usuarioOtro").removeClass("nav-link active");
      $("#usuarioOtro").addClass("nav-link");

      $("#posteo").removeClass("nav-link active");
      $("#posteo").addClass("nav-link");


   
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

      $("#cursos").removeClass("nav-link active");
      $("#cursos").addClass("nav-link");

      $("#cargaAlumno").removeClass("nav-link active");
      $("#cargaAlumno").addClass("nav-link");

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

      $("#parteDiario").removeClass("nav-link active");
      $("#parteDiario").addClass("nav-link");


      $("#parteDiarioCargo").removeClass("nav-link active");
      $("#parteDiarioCargo").addClass("nav-link");

      $("#parteDiarioProyecto").removeClass("nav-link active");
      $("#parteDiarioProyecto").addClass("nav-link");

      $("#asistenciaDocente").removeClass("nav-link active");
      $("#asistenciaDocente").addClass("nav-link");

      $("#circularProfe").removeClass("nav-link active");
      $("#circularProfe").addClass("nav-link");

      $("#mensajePublico").removeClass("nav-link active");
      $("#mensajePublico").addClass("nav-link");


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

    }


 


    $("#modeloUno").click(function(){

      $("#body1").removeClass("hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed");
      $("#body1").addClass("hold-transition sidebar-mini layout-fixed");
      

      sacarSelect();

      $("#modeloUno").removeClass("nav-link");
      $("#modeloUno").addClass("nav-link active");
   
    });












     $("#planillaCentralizadora").click(function(){ 
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

    $("#usuarioAdmin").click(function(){ 
        $('#imagenProceso').show();
         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
      
        $('#buscarTablaInstitucional').html(''); 
        $('#tablaInstitucional').load('modulos/herramientas/usuarios/usuarioSistema.php');
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#usuarioAdmin").removeClass("nav-link");
        $("#usuarioAdmin").addClass("nav-link active"); 
    });



    $("#datos_Institucion").click(function(){ 
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



        

    
    $("#ciclo").click(function(){
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




    $("#encabesados").click(function(){
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

    $("#cargaAlumno").click(function(){
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

    $("#cargaDocente").click(function(){
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
        $('#imagenProceso').show();
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('usuarios/usuarioSistema.php');
        sacarSelect();
        $("#cargaUsuarios").removeClass("nav-link");
        $("#cargaUsuarios").addClass("nav-link active");
        
    });


    $("#inscripNota").click(function(){

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


 

$("#parteDiario").click(function(){



        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/partes/buscarFecha.php');
         
      
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#parteDiario").removeClass("nav-link");
        $("#parteDiario").addClass("nav-link active");
        

    });




$("#parteDiarioCargo").click(function(){



        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/partesCargo/buscarFecha.php');
         
      
        $('#contenidoAyuda').html(''); 
          
        sacarSelect();
        $("#parteDiarioCargo").removeClass("nav-link");
        $("#parteDiarioCargo").addClass("nav-link active");
        

    });





$("#parteDiarioProyecto").click(function(){



        $('#imagenProceso').show();
        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        $('#buscarTablaInstitucional').html('');
        $('#buscarTablaInstitucional').load('modulos/gestionAcademicaDocente/partesProyecto/buscarFecha.php');
         
      
        $('#contenidoAyuda').html(''); 
        sacarSelect();
        $("#parteDiarioProyecto").removeClass("nav-link");
        $("#parteDiarioProyecto").addClass("nav-link active");
        
 


    });

    $("#posteo").click(function(){
    
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
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/asistencia/asistenciaAlumno.php');
        
        sacarSelect();
        $("#asistenciaAlumno").removeClass("nav-link");
        $("#asistenciaAlumno").addClass("nav-link active"); 
    });

      $("#asistenciaDocente").click(function(){
        $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/asistencia/asistenciaDocente.php');
        sacarSelect();
        $("#asistenciaDocente").removeClass("nav-link");
        $("#asistenciaDocente").addClass("nav-link active");

        
    });

    $("#directivoDatos").click(function(){
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

       $("#anuncioAlumno").click(function(){
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

         $("#mensajePublico").click(function(){
          $('#imagenProceso').show();
        $('#contenidoAyuda').html(''); 
           $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
        
        $('#buscarTablaInstitucional').html('');
        $('#tablaInstitucional').load('modulos/paginaInicio/mensajePublico/mensajePaginaPrincipal.php');
        
        sacarSelect();
        $("#mensajePublico").removeClass("nav-link");
        $("#mensajePublico").addClass("nav-link active");
        
        
    });

       $("#anuncioProfe").click(function(){
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




modeloDos

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