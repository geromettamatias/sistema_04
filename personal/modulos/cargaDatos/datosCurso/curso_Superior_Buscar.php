<?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();

                  $cat="";


                  $consulta = "SELECT `id_ciclo`, `ciclo`, `edicion` FROM `ciclo_lectivo` ORDER BY `ciclo`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $ciclo=$da1t['ciclo'];
                    $edicion=$da1t['edicion'];

                     $cat.="<option value='".$ciclo."||".$edicion."'>".$ciclo."- Editar: ".$edicion."</option>";


                  }

?>








  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title"> Gestión-Usuarios Adminstrador del sitio (solo Administrador)</h3>

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

            
                <button id="btn_regresar" type="button" class="btn btn-info" data-toggle="modal"><i class='fas fa-reply-all'></i> Regresar</button><br> <hr>     



                    <select class="form-control" id="cicloLectivo">
              <option>Seleccione un año lectivo</option>
              <?php echo $cat;  ?>
            </select><br>


            <select class="form-control" id="planSeleC">
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
                <?php  } ?>  
              </select><br>

              <select class="form-control" id="cursoSele">
                <option>Seleccione ciclo</option>
                <option>3° AÑO (1° AÑO S.C.)</option>
                <option>4° AÑO (2° AÑO S.C.)</option>
                <option>5° AÑO (3° AÑO S.C.)</option>
                <option>6° AÑO (4° AÑO S.C.)</option>
                <option>7° AÑO (5° AÑO S.C.)</option>
                <option>BLA I</option>
                <option>BLA II</option>
                <option>BLA III</option>
                <option>BLA II y III</option>
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
  $('#imagenProceso').hide();
      $('#cargaCiclo').hide();
  $("#cursoSele").change(function(){

      cursoSele= $('#cursoSele').val();
      planSeleC= $('#planSeleC').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSele!='Seleccione ciclo' && planSeleC!='1' && cicloLectivo!='Seleccione un año lectivo') {
      
       $.ajax({
          type:"post",
          data:'cursoSele=' + cursoSele+'&planSeleC=' + planSeleC+'&cicloLectivo=' + cicloLectivo,
          url:'modulos/cargaDatos/datosCurso/elementos/seccionCursos.php',
          beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar").disabled = true;
                             
                                $('#cargaCiclo').show();
                              },
        
          success:function(r){
          
           $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Superior.php');
           $("#imagenProceso").hide();
                                document.getElementById("btn_regresar").disabled = false;
                             
                                $('#cargaCiclo').hide();
          }
        });

        }else{

          $('#tablaInstitucional').html('');
           $('#imagenProceso').hide();
           document.getElementById("btn_regresar").disabled = false;
                             
                                $('#cargaCiclo').hide();

        }

      });

    $("#planSeleC").change(function(){

      cursoSele= $('#cursoSele').val();
      planSeleC= $('#planSeleC').val();
      cicloLectivo= $('#cicloLectivo').val();


    if (cursoSele!='Seleccione ciclo' && planSeleC!='1' && cicloLectivo!='Seleccione un año lectivo') {
      
       $.ajax({
          type:"post",
          data:'cursoSele=' + cursoSele+'&planSeleC=' + planSeleC+'&cicloLectivo=' + cicloLectivo,
          url:'modulos/cargaDatos/datosCurso/elementos/seccionCursos.php',
          beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar").disabled = true;
                             
                                $('#cargaCiclo').show();
                              },
         
          success:function(r){
          
           $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Superior.php');
           $("#imagenProceso").hide();
                                document.getElementById("btn_regresar").disabled = false;
                             
                                $('#cargaCiclo').hide();
          }
        });

        }else{

          $('#tablaInstitucional').html('');
           $('#imagenProceso').hide();

        }

      });



      $("#cicloLectivo").change(function(){

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

      cursoSele= $('#cursoSele').val();
      planSeleC= $('#planSeleC').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSele!='Seleccione ciclo' && planSeleC!='1' && cicloLectivo!='Seleccione un año lectivo') {
      
       $.ajax({
          type:"post",
          data:'cursoSele=' + cursoSele+'&planSeleC=' + planSeleC+'&cicloLectivo=' + cicloLectivo,
          url:'modulos/cargaDatos/datosCurso/elementos/seccionCursos.php',
          beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar").disabled = true;
                             
                                $('#cargaCiclo').show();
                              },
     
          success:function(r){
          
           $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Superior.php');
           $("#imagenProceso").hide();
                                document.getElementById("btn_regresar").disabled = false;
                             
                                $('#cargaCiclo').hide();
          }
        });

        }else{

          $('#tablaInstitucional').html('');
           $('#imagenProceso').hide();

           
   $.unblockUI();

        }

      });


    $("#btn_regresar").click(function(){


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
        $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/Selepcion_Curso.php');
        $('#imagenProceso').hide();
        
    });
  

   $.unblockUI();
  </script>

