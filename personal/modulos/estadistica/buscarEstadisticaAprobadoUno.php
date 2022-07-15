<?php
                  
                  include_once '../bd/conexion.php';
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
<br>




            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-edit"></i>
                    Marticulación al curso lectivo (del Alumno)
                </h3>
              </div>
              <div class="card-body">

                

                <select class="form-control" id="cicloLectivoFina">
                        <option>Seleccione un año lectivo</option>
                        <?php echo $cat;  ?>
                </select> 

               
              </div>
              <!-- /.card -->
            </div>




       
        <div id="contenidoCursos"></div>

<script type="text/javascript">

   $('#imagenProceso').hide();
  $("#cicloLectivoFina").change(function(){
    cicloLectivoFina= $('#cicloLectivoFina').val();
   
    if (cicloLectivoFina!='Seleccione un año lectivo') {

     $.ajax({
          type:"post",
          data:'cicloLectivo=' + cicloLectivoFina,
          url:'modulos/estadistica/elementos/session.php',
          success:function(r){
            $('#contenidoCursos').load('modulos/estadistica/buscarEstadisticaAprobadoDos.php');
          }
        });

     }else{

        $('#contenidoCursos').html('');
        $('#tablaInstitucional').html('');



     }

   });



</script>
