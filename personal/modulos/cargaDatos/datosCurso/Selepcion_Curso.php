



  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Administración de Cursos</h3>

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



                  <button id="btn_cursos_basico" type="button" class="btn btn-outline-success btn-block" data-toggle="modal">CURSOS DEL BÁSICO <i class='fas fa-edit'></i></button>
                  <p><b>Aclaración:</b> Podras crear,editar y eliminar cursos con las asignaturas correspondiente a todos los planes de estudios...</p>

                  <button id="btn_cursos_superior" type="button" class="btn btn-outline-info btn-block" data-toggle="modal">CURSOS DEL SUPERIOR <i class='fas fa-edit'></i></button>
                  <p><b>Aclaración:</b> Podras crear,editar y eliminar cursos con las asignaturas correspondiente a un plan particular...</p>







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

		    $("#btn_cursos_basico").click(function(){


          
          

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
		        $('#contenidoAyuda').html(''); 
		        $('#buscarTablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Basico_Buscar.php');
             $('#tablaInstitucional').html('');

             $('#imagenProceso').hide(); 
		      });

		     $("#btn_cursos_superior").click(function(){

          
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
		            $('#contenidoAyuda').html(''); 
		            $('#buscarTablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Superior_Buscar.php');

                 $('#tablaInstitucional').html(''); 
	               $('#imagenProceso').hide(); 
		      });
	      });


  

 $.unblockUI();
  </script>

