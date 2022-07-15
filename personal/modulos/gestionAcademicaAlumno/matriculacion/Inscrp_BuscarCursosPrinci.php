<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
 

            <!-- STACKED BAR CHART -->
            <div class="card card-success">
              
              <div class="card-header">
                <h3 class="card-title">El Curso</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button onclick="remover2()" type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>


              <div class="card-body">
                <div class="chart">
                  
<select class="form-control" id="cursoSe">
                 <option>Seleccione un Curso</option>
            <?php
                  
                  include_once '../../bd/conexion.php';
                  $objeto = new Conexion();
                  $conexion = $objeto->Conectar();



                 session_start();

          

$cicloF=$_SESSION['cicloLectivo'];

$cicloFF = explode("||", $cicloF);
$cicloLectivo= $cicloFF[0]; 
$edicion= $cicloFF[1]; 




                $nivelCurso=$_SESSION["nivelCurso"];
                $nivel = explode(',',$nivelCurso);
                $nivelCantidad=count($nivel);

           
                  for ($i=0; $i < $nivelCantidad; $i++) { 

                    $ni = $nivel[$i];



                    if ($ni=='TODOS') {
                      
                 

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
                    <?php } }

        

                  $consulta = "SELECT `idCurso`, `idPlan`, `ciclo`, `nombre` FROM `curso_$cicloLectivo` WHERE `idPlan`='básico' AND `nombre`='$ni'";
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



                  if ($ni=='TODOS') {


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
                    <?php }
                      
                 




                 }


           
                  $consulta = "SELECT `curso_$cicloLectivo`.`idCurso`, `plan_datos`.`nombre`, `curso_$cicloLectivo`.`nombre` AS 'nombreCurso' FROM `curso_$cicloLectivo` INNER JOIN `plan_datos` ON `plan_datos`.`idPlan`= `curso_$cicloLectivo`.`idPlan` AND `curso_$cicloLectivo`.`nombre`='$ni'";
                  $resultado = $conexion->prepare($consulta);
                  $resultado->execute();
                  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  foreach($data as $dat) { 
                
                    $idCurso=$dat['idCurso'];
                    $nombreCurso=$dat['nombreCurso'];
                    $nombre=$dat['nombre'];

                    ?>
                    <option value="<?php echo $idCurso ?>"><?php echo $nombreCurso.'--'.$nombre ?></option>
                    <?php } 



                       }?>
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
    cursoSe= $('#cursoSe').val();


    if (cursoSe=='Seleccione un Curso') {
      $('#tablaInstitucional').html('');
      return false;
    }

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
          type:"post",
          data:'cursoSe=' + cursoSe,
          url:'modulos/gestionAcademicaAlumno/matriculacion/elementos/seccionCursosFINAL.php',
          success:function(r){
            $('#tablaInstitucional').load('modulos/gestionAcademicaAlumno/matriculacion/Inscrip_TablaInscrp.php');
          }
        });
   });



function remover2 () {

  
  

  
  $('#cicloLectivoFina').val('Seleccione un año lectivo');
   $('#contenidoCursos').html('');
      $('#tablaInstitucional').html('');
        $('#contenidoAyuda').html(''); 
        $('#imagenProceso').hide();  





}



 $.unblockUI();
</script>