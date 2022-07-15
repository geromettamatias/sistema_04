



  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">Seleccione un Plan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover()"  type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            
                        <div id="cargaCiclo"><img  src="../elementos/cargando.gif"  style="width: 150px;"></div>

            
                <button id="btn_regresar_asignatura" type="button" class="btn btn-success" data-toggle="modal"><i class='fas fa-reply-all'></i> Regresar</button> <br><hr>  



                  <select class="form-control" id="planSele">
                <option value="1">Seleccione un Plan</option>
                <?php
                      include_once '../../bd/conexion.php';
                      $objeto = new Conexion();
                      $conexion = $objeto->Conectar();

                      $consulta = "SELECT `idPlan`, `idInstitucion`, `nombre`, `numero` FROM `plan_datos`";
                      $resultado = $conexion->prepare($consulta);
                      $resultado->execute();
                      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                      foreach($data as $dat) {
                ?>
                <option value="<?php echo $dat['idPlan'] ?>"><?php echo $dat['nombre'] ?></option>
                <?php } ?> 
              </select>




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
  $(document).ready(function(){
    $('#imagenProceso').hide();
      $('#cargaCiclo').hide();

    $("#planSele").change(function(){

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


      planSele= $('#planSele').val();
      $.ajax({
          type:"post",
          data:'planSele=' + planSele,
          url:'modulos/cargaDatos/datosAsignaturas/elementos/seccionBuscarPlan.php',
          
                      beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar_asignatura").disabled = true;
                                
                                $('#cargaCiclo').show();
                              },
          
          success:function(r){    	
           $('#tablaInstitucional').load('modulos/cargaDatos/datosAsignaturas/asignaturasPlan.php');
            $("#imagenProceso").hide();
                                document.getElementById("btn_regresar_asignatura").disabled = false;
                                
                                $('#cargaCiclo').hide();
                                   $.unblockUI();
          }
        });
    });


    $("#btn_regresar_asignatura").click(function(){
      
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
        $('#tablaInstitucional').load('modulos/cargaDatos/datosAsignaturas/asignaturas_Selec.php');
        $('#imagenProceso').hide(); 
      });

  });


function remover () {

    
    
        $('#imagenProceso').show();
        $('#buscarTablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#tablaInstitucional').load('');
        $('#imagenProceso').hide(); 


}




   $.unblockUI();
</script>

