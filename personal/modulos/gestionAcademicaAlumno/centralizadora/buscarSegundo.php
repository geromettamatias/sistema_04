



  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-info">
              
              <div class="card-header">
                <h3 class="card-title">BUSCAR CURSO</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover4()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  

            

                <select class="form-control" id="cursoSe">
            <option value="0">Seleccione un Curso</option>
            <?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();



                 session_start();

                  $cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 



                  $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idPlan`='básico'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $dat1a=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($dat1a as $da1t) { 
                    $idPlan=$da1t['idPlan'];
                    $idCurso=$da1t['idCurso'];
                    $nombre=$da1t['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombre.'--'.$idPlan ?></option>
                    <?php } ?>

                     <?php


           
                  $consulta = "SELECT `curso_$cicloLectivo`.`idCurso`, `plan_datos`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `curso_$cicloLectivo` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`= `curso_$cicloLectivo`.`idPlan`";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $dat) { 
                
                    $idCurso=$dat['idCurso'];
                    $nombreCurso=$dat['nombreCurso'];
                    $nombre=$dat['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombreCurso.'--'.$nombre ?></option>
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
  $("#cursoSe").change(function(){
     $('#imagenProceso').show();
    cursoSe= $('#cursoSe').val();
    if (cursoSe=='0') {

       $('#contenidoAyuda').html('');
        $('#imagenProceso').hide();
   
     
    }else{


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

 
    $.ajax({
          type:"post",
          data:'cursoSe=' + cursoSe,
          url:'modulos/gestionAcademicaAlumno/centralizadora/elementos/seccionCursosLOO.php',
          success:function(r){

            $('#contenidoAyuda').html('');
            $('#contenidoAyuda').show();
          

           
            $('#contenidoAyuda').load('modulos/gestionAcademicaAlumno/centralizadora/buscarTerero.php');
 
            $('#imagenProceso').hide();  


          }
        });
    }
  });



  function remover4 () {

 

  $('#cicloLectivoFina').val('Seleccione un año lectivo');

         $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');
  
        $('#contenidoAyuda').html(''); 


}



   $.unblockUI();
</script>
