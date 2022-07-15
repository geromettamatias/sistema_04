




  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">ASIGNATURA DEL PLAN DE ESTUDIO</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            
                  
                <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

            

                <button id="btn_asignatura_basico" type="button" class="btn btn-outline-success btn-block" data-toggle="modal">ASIGNATURA DEL BÁSICO <i class='fas fa-edit'></i></button>
            <p><b>Aclaración:</b> Podras crear,editar y eliminar asignatura  correspondiente a todos los planes de estudios...</p>
            <br><hr>
            <button id="btn_asignatura_superior" type="button" class="btn btn-outline-info btn-block" data-toggle="modal">ASIGNATURA DEL SUPERIOR <i class='fas fa-edit'></i></button>
            <p><b>Aclaración:</b> Podras crear,editar y eliminar asignatura  correspondiente a un plan particular...</p>




                </div>
              </div>

              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>








    <script type="text/javascript">
$('#imagenProceso').hide();
      $('#cargaCiclo').hide();
    	$(document).ready(function(){
            
		    $("#btn_asignatura_basico").click(function(){

              $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
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
            $('#buscarTablaInstitucional').html('');
            $('#contenidoAyuda').html(''); 
            $('#tablaInstitucional').load('modulos/cargaDatos/datosAsignaturas/asignaturasBasico.php');
            $('#imagenProceso').hide(); 
		      });

		     $("#btn_asignatura_superior").click(function(){

              $.blockUI({ 
                                    message: '<h1>Espere !!</h1>',
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
            $('#tablaInstitucional').html('');
            $('#contenidoAyuda').html(''); 
            $('#buscarTablaInstitucional').load('modulos/cargaDatos/datosAsignaturas/buscarAsignaturasPlan.php');
            $('#imagenProceso').hide();
		      });
	      });

      $.unblockUI();
       
  </script>
