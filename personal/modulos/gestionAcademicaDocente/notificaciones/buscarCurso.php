
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                  El Curso
                </h3>
              </div>
              <div class="card-body">

                
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
              <!-- /.card -->
            </div>















             
             
    
<script type="text/javascript">
  $("#cursoSe").change(function(){
    cursoSe= $('#cursoSe').val();

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
          url:'modulos/gestionAcademicaDocente/notificaciones/elementos/seccionCurso.php',
          success:function(r){
            $('#tablaInstitucional').load('modulos/gestionAcademicaDocente/notificaciones/notificaciones.php');
          }
        });
   });



 $.unblockUI();
</script>