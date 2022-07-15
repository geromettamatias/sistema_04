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
                <h3 class="card-title">Gestión-Cursos del Basico</h3>

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
                <select class="form-control" id="cursoSeleB">
                <option>Seleccione ciclo</option>
                <option>1° AÑO (1° AÑO P.C.)</option>
                <option>2° AÑO (2° AÑO P.C.)</option>
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

      

      cursoSeleB= $('#cursoSeleB').val();
      cicloLectivo= $('#cicloLectivo').val();


      if (cursoSeleB!='Seleccione ciclo' && cicloLectivo!='Seleccione un año lectivo') {
     
           $.ajax({

              type:"post",
          data:'cursoSeleB=' + cursoSeleB + '&cicloLectivo=' + cicloLectivo,
          beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar").disabled = true;
                               $('#cargaCiclo').show();
                              },

          url:'modulos/cargaDatos/datosCurso/elementos/seccionCursosBasico.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Basico.php');


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


    $("#cursoSeleB").change(function(){
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

      cursoSeleB= $('#cursoSeleB').val();
      cicloLectivo= $('#cicloLectivo').val();

      $("#imagenProceso").show();
      document.getElementById("btn_regresar").disabled = true;
      $('#cargaCiclo').show();


      if (cursoSeleB!='Seleccione ciclo' && cicloLectivo!='Seleccione un año lectivo') {
     
           $.ajax({

              type:"post",
          data:'cursoSeleB=' + cursoSeleB + '&cicloLectivo=' + cicloLectivo,
            beforeSend: function() {
                                $("#imagenProceso").show();
                                document.getElementById("btn_regresar").disabled = true;
                               $('#cargaCiclo').show();
                              },
          url:'modulos/cargaDatos/datosCurso/elementos/seccionCursosBasico.php',
          beforeSend: function() {
            $('#imagenProceso').show();
                              },
          success:function(r){
          
           $('#tablaInstitucional').load('modulos/cargaDatos/datosCurso/curso_Basico.php');
           $("#imagenProceso").hide();
            document.getElementById("btn_regresar").disabled = false;
            $('#cargaCiclo').hide();

          }
        });

      }else{


        $('#tablaInstitucional').html('');
          $('#imagenProceso').hide();

          $("#imagenProceso").hide();
            document.getElementById("btn_regresar").disabled = false;
            $('#cargaCiclo').hide();

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

