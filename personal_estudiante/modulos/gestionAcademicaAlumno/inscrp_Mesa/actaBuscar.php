
<br>

            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  Actas
                </h3>
              </div>
              <div class="card-body">

                


                  <select class="form-control" id="buscarTipo">
                <option>Seleccione el ACTAS</option>
                <option>ACTAS- PARA REGULAR</option>
                <option>ACTAS- PARA LIBRE</option>
                <option>ACTAS- PARA EQUIVALENCIA</option>
                <option>ACTAS- PARA TERMINAL</option>
                
                </select> 

               
              </div>
              <!-- /.card -->
            </div>








<script type="text/javascript">

  $('#imagenProceso').hide();

    $("#buscarTipo").change(function(){


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






      buscarTipo= $('#buscarTipo').val();
      

      if (buscarTipo!='Seleccione el ACTAS') {
      
       $.ajax({
          type:"post",
          data:'buscarTipo=' + buscarTipo,
          url:'modulos/gestionAcademicaAlumno/inscrp_Mesa/elementos/seccionACTA.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){

           
              $('#tablaInstitucional').html(''); 
               $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/inscrp_Mesa/actaTabla.php');
              $('#contenidoAyuda').html(''); 
            

    
              $('#imagenProceso').hide();
          }
        });

      }else{


        $('#tablaInstitucional').html('');

           $.unblockUI();



      }

      });


   $.unblockUI();

  </script>