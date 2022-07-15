$(document).ready(function(){

    $('#tablaInstitucional').load('modulos/extras/inicio/inicio.php');



     $('#cerrarCesionFinal').load('modulos/extras/cerrarSession/modalCerrar.php');


    $('#imagenProceso').hide();

    cargaDatoPagina();


    function sacarSelect() {
      
      $("#analiticoAlumno").removeClass("nav-link active");
      $("#analiticoAlumno").addClass("nav-link");

      $("#libretaDigitalAlumno").removeClass("nav-link active");
      $("#libretaDigitalAlumno").addClass("nav-link");

      $("#inasistencia").removeClass("nav-link active");
      $("#inasistencia").addClass("nav-link");

      $("#mensajeAdministrador").removeClass("nav-link active");
      $("#mensajeAdministrador").addClass("nav-link");

      $("#actaExamen").removeClass("nav-link active");
      $("#actaExamen").addClass("nav-link");


      $("#inscrpMesasExamen").removeClass("nav-link active");
      $("#inscrpMesasExamen").addClass("nav-link");

      $("#visualizarNotaMesa").removeClass("nav-link active");
      $("#visualizarNotaMesa").addClass("nav-link");

      $("#ajustesFinal").removeClass("nav-link active");
      $("#ajustesFinal").addClass("nav-link");


    }


  $("#usuarioTexto").click(function(){

 
      toastr.success('Es el nivel de usuario que está actualmente designado, dentro del sistema');

   
    });


   $("#autoGestionTitulo").click(function(){

      toastr.success('Sistema de Gestión escolar donde administra toda la información institucional');


   
    });

  




    $("#cerrarSession").click(function(){
      $('#imagenProceso').show();


    $(".modal-header").css("background-color", "#DC1738");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("¿Confirma salir y cerrar Sesión?");            
    
    $('#imagenProceso').hide();


  }); 






     $("#ajustesFinal").click(function(){


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
         $.ajax({
          type:"post",
          data:'ob=' + '15',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').load('modulos/extras/ajustes/ajustes.php');
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').show();

                  Swal.fire(
                  'IMPORTANTE !!',
                  'No se olvide de guardar los datos despues de modificarlos',
                  'warning'
                )
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();

                 $.unblockUI();

            }

          
          }
        });




        sacarSelect();

      $("#ajustesFinal").removeClass("nav-link");
      $("#ajustesFinal").addClass("nav-link active");
            
   
        
    });



    $("#analiticoAlumno").click(function(){


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
         $.ajax({
          type:"post",
          data:'ob=' + '2',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/analitico/analitico.php');
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();

                     $.unblockUI();
            }

          
          }
        });

         sacarSelect();

      $("#analiticoAlumno").removeClass("nav-link");
      $("#analiticoAlumno").addClass("nav-link active");
         
        
    });



    $("#inscrpMesasExamen").click(function(){

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
         $.ajax({
          type:"post",
          data:'ob=' + '5',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/inscrp_Mesa/actaBuscar.php');
                $('#tablaInstitucional').html('');
            

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

                $('#imagenProceso').hide();


                     $.unblockUI();
            }

          
          }
        });

         sacarSelect();

      $("#inscrpMesasExamen").removeClass("nav-link");
      $("#inscrpMesasExamen").addClass("nav-link active");
        
    });





    

     $("#libretaDigitalAlumno").click(function(){


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
       $.ajax({
          type:"post",
          data:'ob=' + '1',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
            
            if (r=='SI') {

                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').html('');
                $('#buscarTablaInstitucional').load('modulos/gestionAcademicaAlumno/libreta/buscarLibretaDigital.php');
        

            }else{

              Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

              $('#imagenProceso').hide();

                $.unblockUI();
            }

          
          }
        });


       sacarSelect();

      $("#libretaDigitalAlumno").removeClass("nav-link");
      $("#libretaDigitalAlumno").addClass("nav-link active");
        
    });



      $("#visualizarNotaMesa").click(function(){



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
               $.ajax({
          type:"post",
          data:'ob=' + '5',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
            if (r=='NO') {

                $('#buscarTablaInstitucional').html('');
                $('#contenidoAyuda').html(''); 
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/visualizacion_Mesa/imprimiNotasActas.php');
               
           

            }else{

                Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })
                $('#imagenProceso').hide();

                     $.unblockUI();
            }

          
          }
        });



       sacarSelect();

      $("#visualizarNotaMesa").removeClass("nav-link");
      $("#visualizarNotaMesa").addClass("nav-link active");
        
        
      });
    
      
  


        $("#inasistencia").click(function(){



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
         $.ajax({
          type:"post",
          data:'ob=' + '3',
          url:'estructuras/bd/pregunta.php',
          success:function(r){
          
               if (r=='SI') {



                 $.ajax({
                          url: "modulos/gestionAcademicaAlumno/inasistencia/elementos/cicloAlumno.php",
                          type: "POST",
                          data: '',
                          success: function(r){  

    

                    ret=`<select class="form-control" id="cicloLectivoFina">
                              
                                
                                `+r+`
                                </select></div>`;
                     

                      Swal.fire({
                              title: 'AÑO LECTIVO',
                              html:ret, 
                              focusConfirm: false,
                              showCancelButton: true,                         
                              }).then((result) => {
                                if (result.value) {                                             
                                  cicloLectivoFina = document.getElementById('cicloLectivoFina').value;
                              
                       

                                  inasistenciaIrAluw(cicloLectivoFina);
                                                  
                                }
                        });




                   }        
                      });





            }else{

              Swal.fire({
                        title: 'NO SE PUBLICO TODAVIA',
                        text: 'ESPERE HASTA QUE EL ADMINISTRADOR PUBLIQUE',
                        imageUrl: '../elementos/fuera-de-servicio.jpg',
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                      })

              $('#imagenProceso').hide();


                     $.unblockUI();

            }

          
          }
        });

            
       sacarSelect();

      $("#inasistencia").removeClass("nav-link");
      $("#inasistencia").addClass("nav-link active");
        
        
        
    });






});




 function inasistenciaIrAluw(cicloLectivoFina){



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
        url: "modulos/gestionAcademicaAlumno/inasistencia/elementos/alumnoCicloFinal.php",
        type: "POST",
       
        data: {cicloLectivoFina:cicloLectivoFina},
        success: function(data){  
            

                $('#contenidoAyuda').html(''); 
                $('#buscarTablaInstitucional').html('');
                $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/inasistencia/inasistencia.php');
           
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




